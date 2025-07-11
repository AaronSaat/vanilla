<?php
use yii\helpers\Html;
use yii\grid\GridView;

$this->title = 'Detail Faktur';
$this->params['breadcrumbs'][] = $this->title;
?>
<?php if (Yii::$app->controller->action->id === 'pdf'): ?>
<style>
    body { font-family: Arial, sans-serif; font-size: 12pt; }
    .kop-surat { margin-bottom: 20px; }
    .kop-surat h4 { margin: 0; font-size: 18pt; }
    .kop-surat .info-toko { font-size: 10pt; }
    .table { border-collapse: collapse; width: 100%; }
    .table th, .table td { border: 1px solid #333; padding: 6px; }
    .table th { background: #f2f2f2; }
    .text-end { text-align: right; }
    .text-center { text-align: center; }
    .mb-3 { margin-bottom: 1rem; }
    .mb-4 { margin-bottom: 1.5rem; }
    hr { border: none; border-top: 2px solid #000; margin: 16px 0; }
</style>
<?php endif; ?>
<!-- Kop Surat -->
<div class="kop-surat row mb-3">
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
            <th>Potongan Diskon</th>
            <th>Subtotal</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $subtotal = 0;
        $totalDiskon = 0;

        foreach ($modelFaktur->fakturDetails as $detail) {
            $harga = $detail->barang->harga ?? 0;
            $diskonPersen = $detail->barang->diskon ?? 0;
            $qty = $detail->qty_barang;

            // Hitung diskon nominal per item
            $diskonNominal = ($diskonPersen / 100) * $harga;

            // Total per baris setelah diskon
            $total = ($harga - $diskonNominal) * $qty;
            $subtotal += $total;

            // Total diskon untuk qty barang
            $totalDiskon += $diskonNominal * $qty;
            ?>
            <tr>
                <td><?= Html::encode($detail->barang->nama_barang) ?></td>
                <td><?= Html::encode($qty) ?></td>
                <td><?= Html::encode($detail->barang->satuan->satuan) ?></td>
                <td><?= Html::encode($detail->barang->hargaFormatted) ?></td>
                <td><?= Html::encode($detail->barang->diskonFormatted) ?></td>
                <td><?= 'Rp ' . number_format($diskonNominal, 0, ',', '.') ?></td>
                <td><?= 'Rp ' . number_format($total, 0, ',', '.') ?></td>
            </tr>
        <?php } ?>
    </tbody>
</table>

<div class="col-md-12 mb-4">
    <hr style="border-top: 4px solid #000;" />
</div>

<!-- Total Faktur -->
<div class="row">
    <div class="col-md-3"></div> <!-- kolom kosong 1 -->
    <div class="col-md-3"></div> <!-- kolom kosong 2 -->
    <div class="col-md-3"></div> <!-- kolom kosong 3 -->
    <div class="col-md-3 text-end">
        <strong>Total Faktur:</strong> <?= 'Rp ' . number_format($subtotal, 0, ',', '.') ?>
    </div>
</div>


<?php if (Yii::$app->controller->action->id !== 'pdf'): ?>
<div class="row">
    <div class="col-md-12 text-center">
        <?= Html::a('Kembali', ['index'], ['class' => 'btn btn-primary']) ?>
    </div>
</div>
<?php endif; ?>