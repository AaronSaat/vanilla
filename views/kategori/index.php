<?php
use yii\helpers\Html;
use yii\grid\GridView;

$this->title = 'Daftar Kategori';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="kategori-index">

    <p>
        <?= Html::a('<i class="fas fa-plus"></i> Tambah Kategori', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            'id',
            'nama_kategori',
            'deskripsi',
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{edit} {delete}',
                'buttons' => [
                    'edit' => function ($url, $model, $key) {
                            return Html::a('<i class="fas fa-edit"></i>', ['edit', 'id' => $model->id], [
                                'class' => 'btn btn-warning btn-sm',
                            ]);
                        },
                    'delete' => function ($url, $model, $key) {
                            return Html::a('<i class="fas fa-trash"></i>', ['delete', 'id' => $model->id], [
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