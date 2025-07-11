<?php

namespace app\controllers;

use Yii;
use app\models\Menu;
use yii\web\Controller;

class MenuController extends Controller
{
    public function actionIndex($view = 'table')
    {
        $menu = Menu::find()->all();

        return $this->render('index', [
            'menu' => $menu,
            'view' => $view,
        ]);
    }

    public function actionCreate()
    {
        $model = new Menu();
        $model->harga = (int) Yii::$app->request->post('harga');

        if ($model->load(Yii::$app->request->post())) {
            if ($model->harga <= 0) {
                Yii::$app->session->setFlash('error', 'Harga tidak boleh kosong atau <= 0.');
            } elseif (!$model->kategori_id) {
                Yii::$app->session->setFlash('error', 'Kategori menu harus dipilih.');
            } elseif (!$model->satuan_id) {
                Yii::$app->session->setFlash('error', 'Satuan menu harus dipilih.');
            } elseif ($model->save()) {
                Yii::$app->session->setFlash('success', 'Menu berhasil ditambahkan.');
                return $this->redirect(['index']);
            } else {
                Yii::$app->session->setFlash('error', 'Gagal menyimpan menu. Silakan periksa kembali input Anda.');
            }
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    public function actionPlusStok($id)
    {
        $model = Menu::findOne($id);
        if ($model) {
            $model->stok += 1;
            $model->save(false);
        }
        return $this->redirect(['index']);
    }

    public function actionMinusStok($id)
    {
        $model = Menu::findOne($id);
        if ($model && $model->stok > 0) {
            $model->stok -= 1;
            $model->save(false);
        }
        return $this->redirect(['index']);
    }

    public function actionDelete($id)
    {
        $model = Menu::findOne($id);
        if ($model) {
            $model->delete();
        }

        return $this->redirect(['index']);
    }

    public function actionEdit($id)
    {
        $model = Menu::findOne($id);

        if (!$model) {
            throw new \yii\web\NotFoundHttpException('Data tidak ditemukan.');
        }

        if (Yii::$app->request->isPost) {
            $data = Yii::$app->request->post();
            $model->attributes = $data['Menu'];

            if (isset($data['harga'])) {
                $model->harga = (int) $data['harga'];
            }

            if ($model->harga <= 0) {
                Yii::$app->session->setFlash('error', 'Harga tidak boleh kosong atau <= 0.');
            } elseif (!$model->kategori_id) {
                Yii::$app->session->setFlash('error', 'Kategori menu harus dipilih.');
            } elseif (!$model->satuan_id) {
                Yii::$app->session->setFlash('error', 'Satuan menu harus dipilih.');
            } else if ($model->save()) {
                Yii::$app->session->setFlash('success', 'Menu berhasil diperbarui.');
                return $this->redirect(['index']);
            } else {
                Yii::$app->session->setFlash('error', 'Gagal memperbarui menu.');
            }
        }

        return $this->render('edit', [
            'model' => $model,
        ]);
    }

    public function actionDetail($id)
    {
        $model = Menu::findOne($id);

        if (!$model) {
            throw new \yii\web\NotFoundHttpException('Menu tidak ditemukan.');
        }

        return $this->render('detail', [
            'model' => $model,
        ]);
    }
}
