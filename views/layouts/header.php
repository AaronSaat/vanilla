<?php
use yii\helpers\Html;
use yii\helpers\Url;
?>

<!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-white navbar-light" style="padding-left: 0; padding-right: 0;">
    <!-- Left navbar links -->
    <ul class="navbar-nav" style="padding-left: 15px; padding-right: 15px; border-right: 1px solid #dee2e6;">
        <li class="nav-item">
            <?= Html::a('<i class="fas fa-bars"></i>', '#', [
                'class' => 'nav-link',
                'data-widget' => 'pushmenu',
                'role' => 'button'
            ]) ?>
        </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <?= Html::a('<i class="fas fa-code mr-1"></i> Gii', Url::to(['/gii']), ['class' => 'nav-link']) ?>
        </li>
        <li class="nav-item">
            <?= Html::a('<i class="fas fa-user-shield mr-1"></i> Admin', Url::to(['/admin']), ['class' => 'nav-link']) ?>
        </li>
    </ul>
    <ul class="navbar-nav ml-auto" style="padding-left: 15px; padding-right: 15px; border-left: 1px solid #dee2e6;">
        <!-- User Dropdown Menu -->
        <li class="nav-item dropdown">
            <a class="nav-link d-flex align-items-center" data-toggle="dropdown" href="#">
                <i class="fas <?= Yii::$app->user->isGuest ? 'fa-user-slash' : 'fa-user-check' ?> mr-2"></i>
                <span class="d-none d-sm-inline"><?= Yii::$app->user->isGuest ? 'Guest' : Yii::$app->user->identity->username ?></span>
            </a>
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                <div class="dropdown-item d-flex align-items-center">
                    <i class="fas fa-user-circle fa-2x mr-3"></i>
                    <div>
                        <strong><?= Yii::$app->user->isGuest ? 'Guest' : Yii::$app->user->identity->username ?></strong><br>
                        <small><?= Yii::$app->user->isGuest ? '-' : Yii::$app->user->identity->email ?></small>
                    </div>
                </div>
                <div class="dropdown-divider"></div>
                <?= Html::a('<i class="fas fa-id-card mr-2"></i> Profile Page', ['site/profile'], ['class' => 'dropdown-item']) ?>
                <?php if (Yii::$app->user->isGuest): ?>
                    <?= Html::a('<i class="fas fa-sign-in-alt mr-2"></i> Login', ['site/login'], ['class' => 'dropdown-item']) ?>
                <?php else: ?>
                    <?= Html::a('<i class="fas fa-sign-out-alt mr-2"></i> Logout', ['site/logout'], [
                        'class' => 'dropdown-item',
                        'data-method' => 'post'
                    ]) ?>
                <?php endif; ?>
            </div>
        </li>
    </ul>
</nav>
<!-- /.navbar -->
