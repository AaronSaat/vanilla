<?php

namespace app\controllers;

use Yii;
use app\models\Barang;
use yii\web\Controller;

class BarangController extends Controller
{
    public function actionIndex($view = 'table')
    {
        $barang = Barang::find()->all();

        return $this->render('index', [
            'barang' => $barang,
            'view' => $view,
        ]);
    }

    public function actionCreate()
    {
        $model = new Barang();
        $model->harga = (int) Yii::$app->request->post('harga');

        if ($model->load(Yii::$app->request->post())) {
            if ($model->harga <= 0) {
                Yii::$app->session->setFlash('error', 'Harga tidak boleh kosong atau <= 0.');
            } elseif (!$model->kategori_id) {
                Yii::$app->session->setFlash('error', 'Kategori barang harus dipilih.');
            } elseif (!$model->satuan_id) {
                Yii::$app->session->setFlash('error', 'Satuan barang harus dipilih.');
            } elseif ($model->save()) {
                Yii::$app->session->setFlash('success', 'Barang berhasil ditambahkan.');
                return $this->redirect(['index']);
            } else {
                Yii::$app->session->setFlash('error', 'Gagal menyimpan barang. Silakan periksa kembali input Anda.');
            }
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    public function actionPlusStok($id)
    {
        $model = Barang::findOne($id);
        if ($model) {
            $model->stok += 1;
            $model->save(false);
        }
        return $this->redirect(['index']);
    }

    public function actionMinusStok($id)
    {
        $model = Barang::findOne($id);
        if ($model && $model->stok > 0) {
            $model->stok -= 1;
            $model->save(false);
        }
        return $this->redirect(['index']);
    }

    public function actionDelete($id)
    {
        $model = Barang::findOne($id);
        if ($model) {
            $model->delete();
        }

        return $this->redirect(['index']);
    }

    public function actionEdit($id)
    {
        $model = Barang::findOne($id);

        if (!$model) {
            throw new NotFoundHttpException('Data tidak ditemukan.');
        }

        if (Yii::$app->request->isPost) {
            $data = Yii::$app->request->post();
            $model->attributes = $data['Barang'];

            if (isset($data['harga'])) {
                $model->harga = (int) $data['harga'];
            }

            if ($model->harga <= 0) {
                Yii::$app->session->setFlash('error', 'Harga tidak boleh kosong atau <= 0.');
            } elseif (!$model->kategori_id) {
                Yii::$app->session->setFlash('error', 'Kategori barang harus dipilih.');
            } elseif (!$model->satuan_id) {
                Yii::$app->session->setFlash('error', 'Satuan barang harus dipilih.');
            } else if ($model->save()) {
                Yii::$app->session->setFlash('success', 'Barang berhasil diperbarui.');
                return $this->redirect(['index']);
            } else {
                Yii::$app->session->setFlash('error', 'Gagal memperbarui barang.');
            }
        }

        return $this->render('edit', [
            'model' => $model,
        ]);
    }

    public function actionDetail($id)
    {
        $model = Barang::findOne($id);

        if (!$model) {
            throw new \yii\web\NotFoundHttpException('Barang tidak ditemukan.');
        }

        return $this->render('detail', [
            'model' => $model,
        ]);
    }
}
