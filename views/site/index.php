<?php

/** @var yii\web\View $this */

use yii\helpers\Html;
use yii\helpers\Url;

$this->title = 'Howdy!';
?>
<div class="site-index">

    <!-- <div class="jumbotron text-center bg-transparent mt-5 mb-5">
        <h1 class="display-4">Selamat Datang!</h1>
        <p class="lead">Silakan pilih salah satu fitur berikut.</p>
    </div> -->

    <div class="container">
        <div class="row">
            <?php
            $fitur = [
                ['label' => 'Master Barang', 'icon' => 'fa-box', 'color' => 'info', 'url' => '#'],
                ['label' => 'Kategori', 'icon' => 'fa-tags', 'color' => 'success', 'url' => '#'],
                ['label' => 'Stok Masuk', 'icon' => 'fa-arrow-down', 'color' => 'warning', 'url' => '#'],
                ['label' => 'Stok Keluar', 'icon' => 'fa-arrow-up', 'color' => 'danger', 'url' => '#'],
                ['label' => 'Supplier', 'icon' => 'fa-truck', 'color' => 'primary', 'url' => '#'],
                ['label' => 'Laporan', 'icon' => 'fa-file-alt', 'color' => 'secondary', 'url' => '#'],
                ['label' => 'User', 'icon' => 'fa-users', 'color' => 'dark', 'url' => '#'],
                ['label' => 'Pengaturan', 'icon' => 'fa-cog', 'color' => 'teal', 'url' => '#'],
                ['label' => 'Bantuan', 'icon' => 'fa-question-circle', 'color' => 'orange', 'url' => '#'],
            ];

            foreach ($fitur as $item) {
                echo '<div class="col-lg-4 col-6 mb-4">
                        <div class="small-box bg-' . $item['color'] . '">
                            <div class="inner">
                                <h4>' . Html::encode($item['label']) . '</h4>
                                <p>Klik untuk masuk</p>
                            </div>
                            <div class="icon">
                                <i class="fas ' . $item['icon'] . '"></i>
                            </div>
                            <a href="' . Url::to($item['url']) . '" class="small-box-footer">
                                Masuk <i class="fas fa-arrow-circle-right"></i>
                            </a>
                        </div>
                    </div>';
            }
            ?>
        </div>
    </div>
</div>
