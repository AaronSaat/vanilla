<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'Login';
$this->registerCss("
    body {
        background-color: rgb(16, 116, 66);
    }
");
?>

<div class="d-flex justify-content-center align-items-center flex-column" style="min-height: 100vh;">
    <h2 style="
        font-weight: bold;
        text-shadow: 1px 1px 3px rgba(0,0,0,0.5);
        color: white;
        margin-bottom: 1.5rem;
    ">
        <?= Html::encode($this->title) ?>
    </h2>

    <div class="card shadow" style="
        width: 100%;
        max-width: 400px;
        background-color: rgba(255, 255, 255, 0.9);
        border: none;
    ">
        <div class="card-body">

            <?php if (Yii::$app->session->hasFlash('error')): ?>
                <div class="alert alert-danger">
                    <?= Yii::$app->session->getFlash('error') ?>
                </div>
            <?php endif; ?>

            <?php $form = ActiveForm::begin([
                'id' => 'login-form',
                'enableClientValidation' => true,
            ]); ?>

            <?= $form->field($model, 'username', [
                'template' => '
                    <div class="mb-3">{input}</div>
                    <div class="text-danger">{error}</div>',
            ])->textInput([
                'autofocus' => true,
                'placeholder' => 'Masukkan username',
                'class' => 'form-control',
                'style' => '
                    border: 2px solid rgb(16, 116, 66);
                    box-shadow: none;
                '
            ]) ?>

            <?= $form->field($model, 'password', [
                 'template' => '
                    <div class="mb-3">{input}</div>
                    <div class="text-danger">{error}</div>',
            ])->passwordInput([
                'placeholder' => 'Masukkan password',
                'class' => 'form-control',
                'style' => '
                    border: 2px solid rgb(16, 116, 66);
                    box-shadow: none;
                '
            ]) ?>

            <div class="form-group text-center">
                <?= Html::submitButton('Login', [
                    'class' => 'btn w-100',
                    'name' => 'login-button',
                    'style' => '
                        background-color: rgb(16, 116, 66);
                        border-color: rgb(16, 116, 66);
                        color: white;
                    '
                ]) ?>
            </div>

            <?php ActiveForm::end(); ?>

        </div>
    </div>
</div>
