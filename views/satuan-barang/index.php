<?php
use yii\helpers\Html;
use yii\grid\GridView;

$this->title = 'Daftar Satuan Barang';
$this->params['breadcrumbs'][] = $this->title;

$this->registerJs("
    setTimeout(function() {
        $('.alert').alert('close');
    }, 5000);
");
?>

<div class="satuan-barang-index">
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

    <p>
        <?= Html::a('<i class="fas fa-plus"></i> Tambah Satuan', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => new \yii\data\ArrayDataProvider([
            'allModels' => $satuan,
            'pagination' => false,
        ]),
        'columns' => [
            'id',
            'satuan',
            'keterangan',
            'contoh_barang',
            [
                'class' => 'yii\grid\ActionColumn',
                'header' => 'Action',
                'template' => '{edit} {delete} ',
                'buttons' => [
                    'edit' => function ($url, $model, $key) {
                            return Html::a('<i class="fas fa-edit"></i>', ['satuan-barang/edit', 'id' => $model->id], [
                                'class' => 'btn btn-warning btn-sm',
                            ]);
                        },
                    'delete' => function ($url, $model, $key) {
                            return Html::a('<i class="fas fa-trash"></i>', ['satuan-barang/delete', 'id' => $model->id], [
                                'class' => 'btn btn-danger btn-sm',
                                'data-confirm' => 'Yakin ingin menghapus data ini?',
                                'data-method' => 'post',
                            ]);
                        },
                ],
            ],
        ],
    ]); ?>

</div>