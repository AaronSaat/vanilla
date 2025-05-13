<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'Edit Satuan Barang';
$this->params['breadcrumbs'][] = ['label' => 'Daftar Satuan Barang', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="satuan-barang-update">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'satuan')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'keterangan')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'contoh_barang')->textInput(['maxlength' => true]) ?>

    <div class="form-group text-center">
        <?= Html::submitButton('<i class="fas fa-save"></i> Update', [
            'class' => 'btn btn-success btn-lg px-5'
        ]) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>