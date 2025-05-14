<?php

namespace app\controllers;

use Yii;
use app\models\Kop;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

class KopController extends Controller
{
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Kop::find(),
            'pagination' => [
                'pageSize' => 10,
            ],
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionCreate()
    {
        $model = new Kop();

        if ($model->load(Yii::$app->request->post())) {
            if ($model->logo_toko) {
                $model->logo_toko = UploadedFile::getInstance($model, 'file_logo');
                if (!$model->uploadLogo()) {
                    Yii::$app->session->setFlash('error', 'Gagal upload logo.');
                    return $this->render('create', [
                        'model' => $model,
                    ]);
                }
            }

            if ($model->save(false)) { // skip validation karena sudah dihandle di uploadLogo()
                Yii::$app->session->setFlash('success', 'Data berhasil disimpan.');
                return $this->redirect(['index']);
            }
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }


    public function actionEdit($id)
    {
        $model = Kop::findOne($id);

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
        $model = Kop::findOne($id);

        if (!$model) {
            throw new \yii\web\NotFoundHttpException('Data tidak ditemukan.');
        }

        $model->delete();

        Yii::$app->session->setFlash('success', 'Satuan barang berhasil dihapus.');
        return $this->redirect(['index']);
    }
}
