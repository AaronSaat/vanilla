<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Barang */

$this->title = 'Detail Barang: ' . $model->nama_barang;
$this->params['breadcrumbs'][] = ['label' => 'Master Barang', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="barang-view">

    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title"><?= Html::encode($this->title) ?></h3>
        </div>
        <div class="card-body">

            <div class="row">
                <div class="col-md-6">
                    <div class="card mb-3">
                        <div class="card-header bg-info text-white">
                            <i class="fas fa-info-circle"></i> Informasi Barang
                        </div>
                        <div class="card-body">
                            <p><strong>Kode Barang:</strong> <?= Html::encode($model->kode_barang) ?></p>
                            <hr>
                            <p><strong>Nama Barang:</strong> <?= Html::encode($model->nama_barang) ?></p>
                            <hr>
                            <p><strong>Kategori:</strong> <?= Html::encode($model->kategori->nama_kategori ?? '-') ?></p>
                            <hr>
                            <p><strong>Satuan:</strong> <?= Html::encode($model->satuan->satuan ?? '-') ?></p>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="card text-center mb-3 h-100">
                        <div class="card-body d-flex flex-column justify-content-center align-items-center">
                            <i class="fas fa-box-open fa-7x text-secondary"></i>
                            <p class="mt-3">Gambar Produk</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header bg-warning text-white">
                            <i class="fas fa-calculator"></i> Informasi Angka Barang
                        </div>
                        <div class="card-body">
                            <p><strong>Harga Satuan:</strong> <?= $model->hargaFormatted ?></p>
                            <hr>
                            <p><strong>Diskon:</strong> <?= $model->diskonFormatted ?></p>
                            <hr>
                            <p><strong>Harga Setelah Diskon:</strong> <?= $model->hargaSetelahDiskonFormatted ?></p>
                            <hr>
                            <p><strong>Stok:</strong> <?= $model->stok ?></p>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="card h-100">
                        <div class="card-header bg-secondary text-white">
                            <i class="fas fa-align-left"></i> Deskripsi Barang
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
