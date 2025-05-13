<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'Edit Kategori';
$this->params['breadcrumbs'][] = ['label' => 'Kategori', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="kategori-edit">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'nama_kategori')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'deskripsi')->textarea(['rows' => 3]) ?>

    <div class="form-group text-center">
        <?= Html::submitButton('<i class="fas fa-save"></i> Update', [
            'class' => 'btn btn-success btn-lg px-5'
        ]) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>