<?php
use yii\helpers\Html;
use yii\bootstrap4\Alert;
?>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <h1 class="m-0"><?= Html::encode($this->title) ?></h1>
        </div>
    </div>

    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <?= $content ?>
        </div>
    </div>
</div>
