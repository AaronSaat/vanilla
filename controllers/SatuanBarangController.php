<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\models\SatuanBarang;

class SatuanBarangController extends Controller
{
    public function actionIndex()
    {
        $satuan = SatuanBarang::find()->orderBy('id')->all();

        return $this->render('index', [
            'satuan' => $satuan,
        ]);
    }

    public function actionCreate()
    {
        $model = new SatuanBarang();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('success', 'Satuan barang berhasil ditambahkan.');
            return $this->redirect(['index']);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    public function actionEdit($id)
    {
        $model = SatuanBarang::findOne($id);

        if (!$model) {
            throw new \yii\web\NotFoundHttpException('Data tidak ditemukan.');
        }

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('success', 'Satuan barang berhasil diperbarui.');
            return $this->redirect(['index']);
        }

        return $this->render('edit', [
            'model' => $model,
        ]);
    }
    public function actionDelete($id)
    {
        $model = SatuanBarang::findOne($id);

        if (!$model) {
            throw new \yii\web\NotFoundHttpException('Data tidak ditemukan.');
        }

        $model->delete();

        Yii::$app->session->setFlash('success', 'Satuan barang berhasil dihapus.');
        return $this->redirect(['index']);
    }

}
