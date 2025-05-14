<?php
use yii\helpers\Html;
use yii\grid\GridView;

$this->title = 'Detail Faktur';
$this->params['breadcrumbs'][] = $this->title;
?>
<!-- Kop Surat -->
<div class="row mb-3">
    <!-- Kolom 1: Logo -->
    <div class="col-md-2 d-flex align-items-center justify-content-center" style="min-height: 120px;">
        <?php if ($modelFaktur->kop->logo_toko): ?>
            <?= Html::img($modelFaktur->kop->logo_toko, ['alt' => 'Logo Toko', 'class' => 'img-fluid', 'style' => 'max-height: 100px;']) ?>
        <?php else: ?>
            <i class="fas fa-store-alt fa-5x text-secondary"></i>
        <?php endif; ?>
    </div>


    <!-- Kolom 2: Informasi Toko -->
    <div class="col-md-8">
        <h4><?= Html::encode($modelFaktur->kop->nama_toko) ?></h4>
        <strong>Nomor Surat Izin:</strong> <?= Html::encode($modelFaktur->kop->nomor_surat_izin_toko ?: '-') ?><br>
        <strong>Alamat:</strong> <?= Html::encode($modelFaktur->kop->alamat_toko ?: '-') ?><br>
        <strong>Nomor:</strong> <?= Html::encode($modelFaktur->kop->nomor_toko ?: '-') ?>,
        <strong>Email:</strong> <?= Html::encode($modelFaktur->kop->email_toko ?: '-') ?>,
        <strong>Website:</strong> <?= Html::encode($modelFaktur->kop->website_toko ?: '-') ?><br>
        <strong>Jenis Faktur:</strong> <?= Html::encode($modelFaktur->jenis_faktur) ?><br>
    </div>


    <!-- Kolom 3: Jenis Faktur -->
    <div class="col-md-2 d-flex justify-content-center align-items-center text-center">
        <h3 class="text-uppercase">FAKTUR <?= Html::encode($modelFaktur->jenis_faktur) ?></h3>
    </div>

</div>


<div class="col-md-12 mb-4">
    <hr style="border-top: 4px solid #000;" />
</div>

<!-- Header Faktur -->
<div class="row">
    <div class="col-md-6">
        <strong>Nomor Faktur:</strong> <?= Html::encode($modelFaktur->nomor_faktur) ?><br>
        <strong>Nama Kasir:</strong> <?= Html::encode($modelFaktur->nama_kasir) ?><br>
        <strong>Jenis Pembayaran:</strong> <?= Html::encode($modelFaktur->jenis_pembayaran) ?><br>
        <strong>Status:</strong> <?= Html::encode($modelFaktur->status) ?><br>
    </div>

    <div class="col-md-6">
        <strong>Nama Customer:</strong> <?= Html::encode($modelFaktur->nama_customer) ?><br>
        <strong>Nomor Telepon:</strong> <?= Html::encode($modelFaktur->nomor_telpon_customer) ?><br>
        <strong>Alamat:</strong> <?= Html::encode($modelFaktur->alamat_customer) ?><br>
    </div>
</div>

<div class="col-md-12 mb-4">
    <hr style="border-top: 4px solid #000;" />
</div>

<!-- Body Faktur (Detail Barang) -->
<h4>Detail Barang</h4>
<table class="table table-bordered">
    <thead>
        <tr>
            <th>Barang</th>
            <th>Qty</th>
            <th>Satuan</th>
            <th>Harga</th>
            <th>Diskon</th>
            <th>Subtotal</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $subtotal = 0;
        foreach ($modelFaktur->fakturDetails as $detail) {
            $harga = $detail->barang->harga ?? 0; // Ambil harga dari barang terkait
            $diskon = $detail->diskon ?? 0; // Misalnya, diskon bisa ditambahkan pada model
            $total = ($harga - $diskon) * $detail->qty_barang;
            $subtotal += $total;
            ?>
            <tr>
                <td><?= Html::encode($detail->barang->nama_barang) ?></td>
                <td><?= Html::encode($detail->qty_barang) ?></td>
                <td><?= Html::encode($detail->barang->satuan->satuan) ?></td>
                <td><?= Html::encode($detail->barang->hargaFormatted) ?></td>
                <td><?= Html::encode($detail->barang->diskonFormatted) ?></td>
                <td><?= Yii::$app->formatter->asCurrency($subtotal) ?></td>
            </tr>
        <?php } ?>
    </tbody>
</table>

<div class="col-md-12 mb-4">
    <hr style="border-top: 4px solid #000;" />
</div>

<!-- Total Faktur -->
<div class="col-md-6 text-end">
    <strong>Total Faktur:</strong> <?= Yii::$app->formatter->asCurrency($subtotal) ?>
</div>

<div class="row">
    <div class="col-md-12 text-center">
        <?= Html::a('Kembali', ['index'], ['class' => 'btn btn-primary']) ?>
    </div>
</div>