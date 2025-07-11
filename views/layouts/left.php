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
                    <a href="<?= \yii\helpers\Url::to(['/menu/index']) ?>" class="nav-link">
                        <i class="nav-icon fas fa-utensils"></i>
                        <p>Master Menu</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="<?= \yii\helpers\Url::to(['/satuan-barang/index']) ?>" class="nav-link">
                        <i class="nav-icon fas fa-list-ol"></i>
                        <p>Satuan Barang</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="<?= \yii\helpers\Url::to(['/kategori/index']) ?>" class="nav-link">
                        <i class="nav-icon fas fa-layer-group"></i>
                        <p>Kategori Barang</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="<?= \yii\helpers\Url::to(['/faktur/index']) ?>" class="nav-link">
                        <i class="nav-icon fas fa-file-invoice"></i>
                        <p>Faktur</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="<?= \yii\helpers\Url::to(['/pesanan/index']) ?>" class="nav-link">
                        <i class="nav-icon fas fa-concierge-bell"></i>
                        <p>Pesanan</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="<?= \yii\helpers\Url::to(['/kop/index']) ?>" class="nav-link">
                        <i class="nav-icon fas fa-file-signature"></i>
                        <p>Kop Surat</p>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
</aside>
