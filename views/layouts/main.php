<?php

/** @var yii\web\View $this */
/** @var string $content */

use app\assets\AppAsset;
use app\widgets\Alert;
use yii\bootstrap4\Breadcrumbs;
use yii\bootstrap4\Html;
use yii\bootstrap4\Nav;
use yii\bootstrap4\NavBar;
use hail812\adminlte3\assets\AdminLteAsset;

AdminLteAsset::register($this);

$this->registerCssFile('https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css');
$this->registerJsFile('https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js', ['depends' => [\yii\web\JqueryAsset::class]]);
// format text field input harga
$this->registerJsFile('https://cdn.jsdelivr.net/npm/autonumeric@4.6.0/dist/autoNumeric.min.js', ['depends' => [\yii\web\JqueryAsset::class]]);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
  <meta charset="<?= Yii::$app->charset ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="..." crossorigin="anonymous">
  <?= Html::csrfMetaTags() ?>
  <title><?= Html::encode($this->title) ?></title>
  <?php $this->head() ?>
</head>
<body class="hold-transition sidebar-mini">
<?php $this->beginBody() ?>

<div class="wrapper">
  <?= $this->render('header') ?>
  <?= $this->render('left') ?>
  <?= $this->render('content', ['content' => $content]) ?>
  <?= $this->render('footer') ?>
</div>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
 