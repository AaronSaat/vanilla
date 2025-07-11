<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Menu */

$this->title = 'Detail Menu: ' . $model->nama_menu;
$this->params['breadcrumbs'][] = ['label' => 'Master Menu', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="menu-view"></div>

    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title"><?= Html::encode($this->title) ?></h3>
        </div>
        <div class="card-body">

            <div class="row">
                <div class="col-md-6">
                    <div class="card mb-3">
                        <div class="card-header bg-info text-white">
                            <i class="fas fa-info-circle"></i> Informasi Menu
                        </div>
                        <div class="card-body">
                            <p><strong>Kode Menu:</strong> <?= Html::encode($model->kode_menu) ?></p>
                            <hr>
                            <p><strong>Nama Menu:</strong> <?= Html::encode($model->nama_menu) ?></p>
                            <hr>
                            <p><strong>Kategori:</strong> <?= Html::encode($model->kategori->nama_kategori ?? '-') ?></p>
                            <hr>
                            <p><strong>Satuan:</strong> <?= Html::encode($model->satuan->satuan ?? '-') ?></p>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="card text-center mb-3 h-100">
                        <div class="card-body d-flex justify-content-center align-items-center" style="height: 2r50px;">
                            <img src="https://images.unsplash.com/photo-1513104890138-7c749659a591?auto=format&fit=crop&w=300&q=80" alt="Mockup Gambar Menu" class="img-fluid rounded" style="max-height: 200px; max-width: 100%; object-fit: cover; width: 100%; height: 100%;">
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header bg-warning text-white">
                            <i class="fas fa-calculator"></i> Informasi Angka Menu
                        </div>
                        <div class="card-body">
                            <p><strong>Harga:</strong> <?= Yii::$app->formatter->asCurrency($model->harga) ?></p>
                            <hr>
                            <p><strong>Stok:</strong> <?= $model->stok ?></p>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="card h-100">
                        <div class="card-header bg-secondary text-white">
                            <i class="fas fa-align-left"></i> Deskripsi Menu
                        </div>
                        <div class="card-body">
                            <p><?= nl2br(Html::encode($model->deskripsi ?: '- Tidak ada deskripsi -')) ?></p>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

</div>
