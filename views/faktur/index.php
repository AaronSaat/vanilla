<?php
use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\FakturSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Daftar Faktur';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="faktur-index">

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
        <?= Html::a('<i class="fas fa-plus"></i> Buat Faktur Baru', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'nomor_faktur',
            'created_at',
            'nama_customer',
            'jenis_faktur',
            'status',
            [
                'class' => 'yii\grid\ActionColumn',
                'header' => 'Action',
                'template' => '{view} {update} {delete} {plus} {minus}',
                'buttons' => [
                    'view' => function ($url, $model, $key) {
                            return Html::a('<i class="fas fa-eye"></i>', ['faktur/detail', 'id' => $model->id], [
                                'class' => 'btn btn-info btn-sm',
                            ]);
                        },
                    'update' => function ($url, $model, $key) {
                            return Html::a('<i class="fas fa-edit"></i>', ['faktur/edit', 'id' => $model->id], [
                                'class' => 'btn btn-warning btn-sm',
                            ]);
                        },
                    'delete' => function ($url, $model, $key) {
                            return Html::a('<i class="fas fa-trash"></i>', ['faktur/delete', 'id' => $model->id], [
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