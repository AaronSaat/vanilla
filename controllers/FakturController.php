<?php

namespace app\controllers;

use Yii;
use app\models\Barang;
use app\models\Faktur;
use app\models\FakturDetail;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use Mpdf\Mpdf;

class FakturController extends Controller
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }


    public function actionIndex()
    {
        $dataProvider = new \yii\data\ActiveDataProvider([
            'query' => Faktur::find(),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionDetail($id)
    {
        return $this->render('detail', [
            'modelFaktur' => $this->findModel($id),
        ]);
    }

    public function actionCreate()
    {
        date_default_timezone_set('Asia/Jakarta');
        $modelFaktur = new Faktur();
        $modelFakturDetail = $modelFaktur->fakturDetails;

        if ($modelFaktur->load(Yii::$app->request->post()) && $modelFaktur->save()) {
            $details = Yii::$app->request->post('FakturDetail', []);

            $validDetails = [];
            foreach ($details as $detail) {
                if (!empty($detail['barang_id']) && !empty($detail['quantity']) && $detail['quantity'] > 0) {
                    $validDetails[] = $detail;
                }
            }

            if (empty($validDetails)) {
                Yii::$app->session->setFlash('error', 'Detail barang harus diisi minimal 1 item dengan barang dan quantity yang benar.');
                $modelFaktur->delete();
                return $this->render('create', [
                    'modelFaktur' => $modelFaktur
                ]);
            }

            // Cek stok sebelum lanjut
            foreach ($validDetails as $detail) {
                $barang = Barang::findOne($detail['barang_id']);
                if (!$barang) {
                    Yii::$app->session->setFlash('error', 'Barang tidak ditemukan.');
                    $modelFaktur->delete();
                    return $this->render('create', ['modelFaktur' => $modelFaktur]);
                }

                if ($barang->stok <= 0) {
                    Yii::$app->session->setFlash('error', 'Stok barang "' . $barang->nama_barang . '" habis.');
                    $modelFaktur->delete();
                    return $this->render('create', ['modelFaktur' => $modelFaktur]);
                }

                if ($detail['quantity'] > $barang->stok) {
                    Yii::$app->session->setFlash('error', 'Stok barang "' . $barang->nama_barang . '" tidak mencukupi.');
                    $modelFaktur->delete();
                    return $this->render('create', ['modelFaktur' => $modelFaktur]);
                }
            }

            // Simpan detail faktur
            foreach ($validDetails as $detail) {
                $modelDetail = new FakturDetail();
                $modelDetail->faktur_id = $modelFaktur->id;
                $modelDetail->barang_id = $detail['barang_id'];
                $modelDetail->qty_barang = $detail['quantity'];
                $modelDetail->deskripsi = $detail['deskripsi'];
                $modelDetail->save();
            }

            // Kurangi stok jika status == 'Selesai'
            if (strtolower($modelFaktur->status) == 'selesai') {
                foreach ($validDetails as $detail) {
                    $barang = Barang::findOne($detail['barang_id']);
                    $barang->stok -= $detail['quantity'];
                    $barang->save(false);
                }
            }

            Yii::$app->session->setFlash('success', 'Faktur berhasil dibuat.');
            return $this->redirect(['index']);
        }

        return $this->render('create', [
            'modelFaktur' => $modelFaktur
        ]);
    }
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    public function actionCheck($id)
    {
        $model = Faktur::findOne($id);
        if (!$model) {
            throw new NotFoundHttpException('Faktur tidak ditemukan.');
        }

        if (strtolower($model->status) != 'draft') {
            Yii::$app->session->setFlash('error', 'Hanya faktur dengan status Draft yang bisa diselesaikan.');
            return $this->redirect(['index']);
        }

        // Cek stok masing-masing barang
        foreach ($model->fakturDetails as $detail) {
            $barang = Barang::findOne($detail->barang_id);
            if (!$barang) {
                Yii::$app->session->setFlash('error', "Barang ID {$detail->barang_id} tidak ditemukan.");
                return $this->redirect(['index']);
            }

            if ($barang->stok < $detail->qty_barang) {
                Yii::$app->session->setFlash('error', "Stok barang '{$barang->nama_barang}' tidak mencukupi. Sisa stok: {$barang->stok}.");
                return $this->redirect(['index']);
            }
        }

        // Jika stok cukup, kurangi stok
        foreach ($model->fakturDetails as $detail) {
            $barang = Barang::findOne($detail->barang_id);
            $barang->stok -= $detail->qty_barang;
            $barang->save(false);
        }

        $model->status = 'Selesai';
        if ($model->save(false)) {
            Yii::$app->session->setFlash('success', 'Faktur berhasil diselesaikan dan stok berhasil dikurangi.');
        } else {
            Yii::$app->session->setFlash('error', 'Gagal menyelesaikan faktur.');
        }

        return $this->redirect(['index']);
    }

    public function actionEdit($id)
    {
        $modelFaktur = $this->findModel($id);
        $modelFakturDetail = $modelFaktur->fakturDetails;

        if ($modelFaktur->load(Yii::$app->request->post())) {
            $detailsData = Yii::$app->request->post('FakturDetail', []);

            $transaction = Yii::$app->db->beginTransaction();

            // Simpan header faktur dulu (supaya dapat id jika baru)
            if (!$modelFaktur->save()) {
                throw new \Exception('Gagal menyimpan faktur.');
            }

            // Jika faktur Penjualan dan status Selesai, cek stok dulu sebelum hapus detail lama
            if (strtolower($modelFaktur->jenis_faktur) == 'penjualan' && strtolower($modelFaktur->status) == 'selesai') {
                foreach ($detailsData as $detailData) {
                    $barang = Barang::findOne($detailData['barang_id'] ?? 0);
                    if (!$barang) {
                        throw new \Exception("Barang dengan ID {$detailData['barang_id']} tidak ditemukan.");
                    }

                    $qtyRequested = (int) $detailData['qty_barang'];
                    if ($qtyRequested > $barang->stok) {
                        throw new \Exception("Stok tidak cukup untuk barang {$barang->nama_barang}. Stok tersisa: {$barang->stok}, permintaan: {$qtyRequested}.");
                    }
                }
            }

            // Hapus detail faktur lama
            FakturDetail::deleteAll(['faktur_id' => $modelFaktur->id]);

            // Simpan detail baru dan kurangi stok jika faktur Penjualan dan Selesai
            foreach ($detailsData as $detailData) {
                $detail = new FakturDetail();
                $detail->faktur_id = $modelFaktur->id;
                $detail->barang_id = $detailData['barang_id'];
                $detail->qty_barang = $detailData['qty_barang'];
                $detail->deskripsi = $detailData['deskripsi'] ?? '';

                if (!$detail->save()) {
                    throw new \Exception('Gagal menyimpan detail faktur.');
                }

                if (strtolower($modelFaktur->jenis_faktur) == 'penjualan' && strtolower($modelFaktur->status) == 'selesai') {
                    $barang = Barang::findOne($detailData['barang_id']);
                    $barang->stok -= $detailData['qty_barang'];
                    if (!$barang->save(false)) {
                        throw new \Exception("Gagal mengurangi stok untuk barang {$barang->nama_barang}.");
                    }
                }
            }

            $transaction->commit();

            Yii::$app->session->setFlash('success', 'Faktur berhasil diperbarui.');
            return $this->redirect(['index']);
        }

        return $this->render('edit', [
            'modelFaktur' => $modelFaktur,
            'modelFakturDetail' => $modelFakturDetail,
        ]);
    }

    public function actionPdf($id)
    {
        $modelFaktur = $this->findModel($id);

        // Render partial view faktur/detail.php ke HTML string
        $content = $this->renderPartial('detail', [
            'modelFaktur' => $modelFaktur,
        ]);

        // Inisialisasi mPDF
        $mpdf = new \Mpdf\Mpdf([
            'format' => 'A4',
            'orientation' => 'P'
        ]);

        $mpdf->WriteHTML($content);
        $filename = 'Faktur_' . $modelFaktur->nomor_faktur . '.pdf';

        // Output ke browser (download)
        return Yii::$app->response->sendContentAsFile(
            $mpdf->Output($filename, \Mpdf\Output\Destination::STRING_RETURN),
            $filename,
            ['mimeType' => 'application/pdf']
        );
    }

    protected function findModel($id)
    {
        if (($model = Faktur::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested faktur does not exist.');
    }
}
