<?php

namespace app\controllers;

use Yii;
use app\models\Faktur;
use app\models\FakturDetail;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

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

            foreach ($validDetails as $detail) {
                $modelDetail = new FakturDetail();
                $modelDetail->faktur_id = $modelFaktur->id;
                $modelDetail->barang_id = $detail['barang_id'];
                $modelDetail->qty_barang = $detail['quantity'];
                $modelDetail->deskripsi = $detail['deskripsi'];
                $modelDetail->save();
            }
            Yii::$app->session->setFlash('success', 'Faktur berhasil dibuat.');
            return $this->redirect(['index']);
        }

        return $this->render('create', [
            'modelFaktur' => $modelFaktur
        ]);
    }


    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    protected function findModel($id)
    {
        if (($model = Faktur::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested faktur does not exist.');
    }
}
