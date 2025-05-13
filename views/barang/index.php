<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\StringHelper;

/* @var $this yii\web\View */
/* @var $barang app\models\Barang[] */

$this->title = 'Daftar Barang';
$this->params['breadcrumbs'][] = $this->title;

$this->registerJs("
    setTimeout(function() {
        $('.alert').alert('close');
    }, 5000);
");
?>
<div class="barang-index">

    <?php if (Yii::$app->session->hasFlash('success')): ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <?= Yii::$app->session->getFlash('success') ?>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    <?php endif; ?>

    <?php if (Yii::$app->session->hasFlash('error')): ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <?= Yii::$app->session->getFlash('error') ?>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    <?php endif; ?>

    <div class="d-flex justify-content-between mb-3">
        <div>
            <?= Html::a('<i class="fas fa-plus"></i> Tambah Barang', ['barang/create'], ['class' => 'btn btn-success']) ?>
        </div>
        <div class="btn-group" role="group" aria-label="View Switch">
            <?= Html::a('<i class="fas fa-th"></i> Grid View', ['index', 'view' => 'grid'], [
                'class' => $view == 'grid' ? 'btn btn-primary active' : 'btn btn-outline-secondary'
            ]) ?>
            <?= Html::a('<i class="fas fa-list"></i> Table View', ['index', 'view' => 'table'], [
                'class' => $view == 'table' ? 'btn btn-primary active' : 'btn btn-outline-secondary'
            ]) ?>
        </div>
    </div>


    <?php if ($view == 'grid'): ?>
        <div class="row">
            <?php if (empty($barang)): ?>
                <div class="col-md-12">
                    <div class="d-flex justify-content-center align-items-center" style="height: 60vh;">
                        <div class="card text-center shadow-sm" style="min-width: 200px;">
                            <div class="card-body">
                                <h5 class="card-title text-muted">
                                    <i class="fas fa-box-open fa-3x mb-3"></i><br>
                                    Tidak ada data barang
                                </h5>
                            </div>
                        </div>
                    </div>
                </div>
            <?php else: ?>
                <?php foreach ($barang as $item): ?>
                    <div class="col-md-3">
                        <div class="card">
                            <div class="card-body">
                                <!-- Nama Barang -->
                                <h5 class="text-center mb-3"><?= Html::encode($item->nama_barang) ?></h5>

                                <!-- Kode Barang -->
                                <div class="d-flex justify-content-between mb-2">
                                    <p class="mb-1">Kode:</p>
                                    <p class="mb-1"><?= Html::encode($item->kode_barang) ?></p>
                                </div>

                                <!-- Kategori Barang -->
                                <div class="d-flex justify-content-between mb-2">
                                    <p class="mb-1">Kategori:</p>
                                    <p class="mb-1"><?= Html::encode($item->kategori->nama_kategori) ?></p>
                                </div>

                                <!-- Satuan Barang -->
                                <div class="d-flex justify-content-between mb-2">
                                    <p class="mb-1">Satuan:</p>
                                    <p class="mb-1"><?= Html::encode($item->satuan->satuan) ?></p>
                                </div>

                                <!-- Deskripsi -->
                                <p class="mb-0 font-weight-bold">Deskripsi:</p>
                                <p class="mb-2 text-muted">
                                    <?= Html::encode(\yii\helpers\StringHelper::truncate($item->deskripsi, 20, '...')) ?>
                                </p>

                                <!-- Harga -->
                                <div class="d-flex justify-content-between mb-2">
                                    <p class="mb-1">Harga:</p>
                                    <button class="btn btn-primary text-bold btn-sm"><?= $item->hargaFormatted ?></button>
                                </div>

                                <!-- Stok -->
                                <div class="d-flex justify-content-between mb-2">
                                    <p class="mb-1">Stok:</p>
                                    <?php if ($item->stok <= 10): ?>
                                        <button class="btn btn-danger text-bold btn-sm"><?= $item->stok ?></button>
                                    <?php else: ?>
                                        <button class="btn btn-primary text-bold btn-sm"><?= $item->stok ?></button>
                                    <?php endif; ?>
                                </div>

                                <!-- Diskon -->
                                <div class="d-flex justify-content-between mb-2">
                                    <p class="mb-1">Diskon:</p>
                                    <button class="btn btn-primary text-bold btn-sm"><?= $item->diskonFormatted ?></button>
                                </div>

                                <div class="text-center mt-3">
                                    <div class="btn-group btn-group-sm" role="group" aria-label="Action Buttons">
                                        <?= Html::a(
                                            '<i class="fas fa-eye"></i>',
                                            ['barang/detail', 'id' => $item->id],
                                            ['class' => 'btn btn-info', 'title' => 'Lihat']
                                        ) ?>
                                        <?= Html::a(
                                            '<i class="fas fa-edit"></i>',
                                            ['barang/edit', 'id' => $item->id],
                                            ['class' => 'btn btn-warning', 'title' => 'Edit']
                                        ) ?>
                                        <?= Html::a(
                                            '<i class="fas fa-trash"></i>',
                                            ['delete', 'id' => $item->id],
                                            [
                                                'class' => 'btn btn-danger',
                                                'title' => 'Hapus',
                                                'data-confirm' => 'Yakin ingin menghapus data ini?',
                                                'data-method' => 'post'
                                            ]
                                        ) ?>
                                        <?= Html::a(
                                            '<i class="fas fa-plus"></i>',
                                            ['barang/plus-stok', 'id' => $item->id],
                                            [
                                                'class' => 'btn btn-success',
                                                'title' => 'Tambah Stok',
                                                'data-method' => 'post'
                                            ]
                                        ) ?>
                                        <?= Html::a(
                                            '<i class="fas fa-minus"></i>',
                                            ['barang/minus-stok', 'id' => $item->id],
                                            [
                                                'class' => 'btn btn-secondary',
                                                'title' => 'Kurangi Stok',
                                                'data-method' => 'post'
                                            ]
                                        ) ?>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    <?php else: ?>
        <?= GridView::widget([
            'dataProvider' => new \yii\data\ArrayDataProvider([
                'allModels' => $barang,
                'pagination' => [
                    'pageSize' => 30,
                ],
            ]),
            'columns' => [
                'kode_barang',
                'nama_barang',
                [
                    'attribute' => 'kategori_id',
                    'value' => function ($model) {
            return $model->kategori ? $model->kategori->nama_kategori : '-';
        },
                    'label' => 'Kategori',
                ],
                [
                    'attribute' => 'satuan_id',
                    'value' => function ($model) {
            return $model->satuan ? $model->satuan->satuan : '-';
        },
                    'label' => 'Satuan',
                ],
                [
                    'label' => 'Deskripsi',
                    'format' => 'raw',
                    'value' => function ($model) {
            $deskripsi = $model->deskripsi;
            if (strlen($deskripsi) > 20) {
                $deskripsi = substr($deskripsi, 0, 20) . '...';
            }
            return '<p class="mb-0 text-muted">' . Html::encode($deskripsi) . '</p>';
        },
                    'contentOptions' => ['class' => 'text-wrap'],
                ],

                [
                    'label' => 'Harga (Satuan)',
                    'format' => 'raw',
                    'value' => function ($model) {
            return $model->hargaFormatted;
        },
                ],
                [
                    'label' => 'Diskon',
                    'format' => 'raw',
                    'value' => function ($model) {
            return $model->diskonFormatted;
        },
                ],

                'stok',
                [
                    'class' => 'yii\grid\ActionColumn',
                    'header' => 'Action',
                    'template' => '{view} {update} {delete} {plus} {minus}',
                    'buttons' => [
                        'view' => function ($url, $model, $key) {
            return Html::a('<i class="fas fa-eye"></i>', ['barang/detail', 'id' => $model->id], [
                'class' => 'btn btn-info btn-sm',
            ]);
        },
                        'update' => function ($url, $model, $key) {
            return Html::a('<i class="fas fa-edit"></i>', ['barang/edit', 'id' => $model->id], [
                'class' => 'btn btn-warning btn-sm',
            ]);
        },
                        'delete' => function ($url, $model, $key) {
            return Html::a('<i class="fas fa-trash"></i>', ['barang/delete', 'id' => $model->id], [
                'class' => 'btn btn-danger btn-sm',
                'data-confirm' => 'Yakin ingin menghapus data ini?',
                'data-method' => 'post',
            ]);
        },
                        'plus' => function ($url, $model, $key) {
            return Html::a('<i class="fas fa-plus"></i>', ['barang/plus-stok', 'id' => $model->id], [
                'class' => 'btn btn-success btn-sm',
                'data-method' => 'post',
            ]);
        },
                        'minus' => function ($url, $model, $key) {
            return Html::a('<i class="fas fa-minus"></i>', ['barang/minus-stok', 'id' => $model->id], [
                'class' => 'btn btn-secondary btn-sm',
                'data-method' => 'post',
            ]);
        },
                    ],
                ],
            ],
        ]); ?>

    <?php endif; ?>

</div>