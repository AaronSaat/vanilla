<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\StringHelper;

/* @var $this yii\web\View */
/* @var $menu app\models\Menu[] */

$this->title = 'Daftar Menu';
$this->params['breadcrumbs'][] = $this->title;

$this->registerJs("
    setTimeout(function() {
        $('.alert').alert('close');
    }, 5000);
");
?>
<div class="menu-index"></div>

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
            <?= Html::a('<i class="fas fa-plus"></i> Tambah Menu', ['menu/create'], ['class' => 'btn btn-success']) ?>
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
            <?php if (empty($menu)): ?>
                <div class="col-md-12">
                    <div class="d-flex justify-content-center align-items-center" style="height: 60vh;">
                        <div class="card text-center shadow-sm" style="min-width: 200px;">
                            <div class="card-body">
                                <h5 class="card-title text-muted">
                                    <i class="fas fa-box-open fa-3x mb-3"></i><br>
                                    Tidak ada data menu
                                </h5>
                            </div>
                        </div>
                    </div>
                </div>
            <?php else: ?>
                <?php foreach ($menu as $item): ?>
                    <div class="col-md-3 mb-4">
                        <div class="card h-100 shadow-sm">
                            <!-- Gambar Menu -->
                            <img src="https://images.unsplash.com/photo-1513104890138-7c749659a591?auto=format&fit=crop&w=300&q=80" class="card-img-top" alt="Gambar Menu" style="object-fit:cover; height:200px;">

                            <div class="card-body d-flex flex-column">
                                <!-- Nama Menu -->
                                <h5 class="card-title text-center mb-2"><?= Html::encode($item->nama_menu) ?></h5>

                                <!-- Kode Menu -->
                                <div class="d-flex justify-content-between mb-1">
                                    <span class="text-muted">Kode</span>
                                    <span><?= Html::encode($item->kode_menu) ?></span>
                                </div>

                                <!-- Kategori Menu -->
                                <div class="d-flex justify-content-between mb-1">
                                    <span class="text-muted">Kategori</span>
                                    <span><?= $item->kategori ? Html::encode($item->kategori->nama_kategori) : '-' ?></span>
                                </div>

                                <!-- Satuan Menu -->
                                <div class="d-flex justify-content-between mb-1">
                                    <span class="text-muted">Satuan</span>
                                    <span><?= $item->satuan ? Html::encode($item->satuan->satuan) : '-' ?></span>
                                </div>

                                <!-- Deskripsi -->
                                <div class="mb-1">
                                    <span class="text-muted">Deskripsi</span>
                                    <p class="mb-0 text-truncate">
                                        <?= Html::encode(\yii\helpers\StringHelper::truncate($item->deskripsi, 20, '...')) ?>
                                    </p>
                                </div>

                                <!-- Harga (Satuan) -->
                                <div class="d-flex justify-content-between mb-1">
                                    <span class="text-muted">Harga</span>
                                    <span class="font-weight-bold"><?= $item->hargaFormatted ?></span>
                                </div>

                                <!-- Stok -->
                                <div class="d-flex justify-content-between mb-1">
                                    <span class="text-muted">Stok</span>
                                    <?php if ($item->stok <= 10): ?>
                                        <span class="badge badge-danger"><?= $item->stok ?></span>
                                    <?php else: ?>
                                        <span class="badge badge-primary"><?= $item->stok ?></span>
                                    <?php endif; ?>
                                </div>

                                <!-- Status -->
                                <div class="d-flex justify-content-between mb-2">
                                    <span class="text-muted">Status</span>
                                    <span><?= Html::encode($item->status) ?></span>
                                </div>

                                <!-- Action Buttons -->
                                <div class="mt-auto text-center">
                                    <div class="btn-group btn-group-sm" role="group" aria-label="Action Buttons">
                                        <?= Html::a(
                                            '<i class="fas fa-eye"></i>',
                                            ['menu/detail', 'id' => $item->id],
                                            ['class' => 'btn btn-info', 'title' => 'Lihat']
                                        ) ?>
                                        <?= Html::a(
                                            '<i class="fas fa-edit"></i>',
                                            ['menu/edit', 'id' => $item->id],
                                            ['class' => 'btn btn-warning', 'title' => 'Edit']
                                        ) ?>
                                        <?= Html::a(
                                            '<i class="fas fa-trash"></i>',
                                            ['menu/delete', 'id' => $item->id],
                                            [
                                                'class' => 'btn btn-danger',
                                                'title' => 'Hapus',
                                                'data-confirm' => 'Yakin ingin menghapus data ini?',
                                                'data-method' => 'post'
                                            ]
                                        ) ?>
                                        <?= Html::a(
                                            '<i class="fas fa-plus"></i>',
                                            ['menu/plus-stok', 'id' => $item->id],
                                            [
                                                'class' => 'btn btn-success',
                                                'title' => 'Tambah Stok',
                                                'data-method' => 'post'
                                            ]
                                        ) ?>
                                        <?= Html::a(
                                            '<i class="fas fa-minus"></i>',
                                            ['menu/minus-stok', 'id' => $item->id],
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
                'allModels' => $menu,
                'pagination' => [
                    'pageSize' => 30,
                ],
            ]),
            'columns' => [
                'kode_menu',
                'nama_menu',
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
                'gambar',
                'stok',
                'status',
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
                    'class' => 'yii\grid\ActionColumn',
                    'header' => 'Action',
                    'template' => '{view} {update} {delete} {plus} {minus}',
                    'buttons' => [
                        'view' => function ($url, $model, $key) {
                            return Html::a('<i class="fas fa-eye"></i>', ['menu/detail', 'id' => $model->id], [
                                'class' => 'btn btn-info btn-sm',
                            ]);
                        },
                        'update' => function ($url, $model, $key) {
                            return Html::a('<i class="fas fa-edit"></i>', ['menu/edit', 'id' => $model->id], [
                                'class' => 'btn btn-warning btn-sm',
                            ]);
                        },
                        'delete' => function ($url, $model, $key) {
                            return Html::a('<i class="fas fa-trash"></i>', ['menu/delete', 'id' => $model->id], [
                                'class' => 'btn btn-danger btn-sm',
                                'data-confirm' => 'Yakin ingin menghapus data ini?',
                                'data-method' => 'post',
                            ]);
                        },
                        'plus' => function ($url, $model, $key) {
                            return Html::a('<i class="fas fa-plus"></i>', ['menu/plus-stok', 'id' => $model->id], [
                                'class' => 'btn btn-success btn-sm',
                                'data-method' => 'post',
                            ]);
                        },
                        'minus' => function ($url, $model, $key) {
                            return Html::a('<i class="fas fa-minus"></i>', ['menu/minus-stok', 'id' => $model->id], [
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
