<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="#" class="brand-link text-center d-block">
        <span class="brand-text font-weight-light">Vanilla</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu">
                <li class="nav-item">
                    <a href="<?= \yii\helpers\Url::to(['/site/index']) ?>" class="nav-link">
                        <i class="nav-icon fas fa-home"></i>
                        <p>Beranda</p>
                    </a>
                </li>
                
                <li class="nav-item">
                    <a href="<?= \yii\helpers\Url::to(['/barang/index']) ?>" class="nav-link">
                        <i class="nav-icon fas fa-box"></i>
                        <p>Master Barang</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="<?= \yii\helpers\Url::to(['/kategori/index']) ?>" class="nav-link">
                        <i class="nav-icon fas fa-tags"></i>
                        <p>Kategori</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="<?= \yii\helpers\Url::to(['/stok-masuk/index']) ?>" class="nav-link">
                        <i class="nav-icon fas fa-arrow-down"></i>
                        <p>Stok Masuk</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="<?= \yii\helpers\Url::to(['/stok-keluar/index']) ?>" class="nav-link">
                        <i class="nav-icon fas fa-arrow-up"></i>
                        <p>Stok Keluar</p>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
</aside>
