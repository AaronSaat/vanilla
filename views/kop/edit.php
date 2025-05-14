<?php

use kartik\file\FileInput;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Kop */
/* @var $form yii\widgets\ActiveForm */

$this->title = 'Edit Kop';
$this->params['breadcrumbs'][] = ['label' => 'Kop', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="kop-form">

    <?php $form = ActiveForm::begin([
        'options' => ['enctype' => 'multipart/form-data'],
    ]); ?>

    <p>Foto toko belum bisa</p>

    <?= $form->field($model, 'nama_toko')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'nomor_surat_izin_toko')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'alamat_toko')->textarea(['rows' => 3]) ?>

    <?= $form->field($model, 'nomor_toko')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'email_toko')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'website_toko')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Update', ['class' => 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
