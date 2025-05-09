<!-- ini untuk implement template tapi tanpa header dan sidebar -->
<?php
use yii\helpers\Html;
use app\assets\AppAsset;

AppAsset::register($this); // agar CSS dan JS tetap dimuat
?>
<?php $this->beginPage(); ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= Html::encode($this->title) ?> - Login</title>
    <?php $this->head(); ?>
</head>
<body class="hold-transition login-page"> <!-- gunakan class AdminLTE -->
<?php $this->beginBody(); ?>

<div class="login-box">
    <?= $content ?>
</div>

<?php $this->endBody(); ?>
</body>
</html>
<?php $this->endPage(); ?>
