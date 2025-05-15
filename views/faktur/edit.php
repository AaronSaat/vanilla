<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\Kop;
use app\models\Barang;

$this->title = 'Edit Faktur #' . $modelFaktur->nomor_faktur;
?>

<?php $form = ActiveForm::begin(['id' => 'form-faktur']); ?>

<?php if (Yii::$app->session->hasFlash('success')): ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <?= Yii::$app->session->getFlash('success') ?>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
<?php endif; ?>

<?php if (Yii::$app->session->hasFlash('error')): ?>
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <?= Yii::$app->session->getFlash('error') ?>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
<?php endif; ?>

<!-- Select Kop Surat -->
<?= $form->field($modelFaktur, 'kop_id')->dropDownList(
    ArrayHelper::map(Kop::find()->all(), 'id', 'nama_toko'),
    ['prompt' => 'Pilih Kop Surat']
) ?>

<div class="col-md-12 mb-4">
    <hr style="border-top: 4px solid #000;" />
</div>

<h4 class="mb-3">Header Faktur</h4>
<div class="row">
    <div class="col-md-6">
        <?= $form->field($modelFaktur, 'nomor_faktur')->textInput(['readonly' => true]) ?>
        <?= $form->field($modelFaktur, 'nama_kasir')->textInput() ?>
        <?= $form->field($modelFaktur, 'jenis_faktur')->dropDownList([
            'Pembelian' => 'Pembelian',
            'Penjualan' => 'Penjualan'
        ], ['prompt' => 'Pilih Jenis Faktur']) ?>
        <?= $form->field($modelFaktur, 'jenis_pembayaran')->dropDownList([
            'Tunai' => 'Tunai',
            'QRIS' => 'QRIS',
            'Debit / Kredit' => 'Debit / Kredit'
        ], ['prompt' => 'Pilih Jenis Pembayaran']) ?>
    </div>

    <div class="col-md-6">
        <?= $form->field($modelFaktur, 'nama_customer')->textInput() ?>
        <?= $form->field($modelFaktur, 'nomor_telpon_customer')->textInput() ?>
        <?= $form->field($modelFaktur, 'alamat_customer')->textarea() ?>
        <?= $form->field($modelFaktur, 'status')->dropDownList([
            'Draft' => 'Draft',
            'Selesai' => 'Selesai',
            'Batal' => 'Batal'
        ], ['prompt' => 'Pilih Status']) ?>
    </div>
</div>

<div class="col-md-12 mb-4">
    <hr style="border-top: 4px solid #000;" />
</div>

<!-- Body Faktur (Detail Barang) -->
<div class="d-flex justify-content-between align-items-center mb-3">
    <h4 class="mb-0">Detail Barang</h4>
    <button type="button" class="btn btn-primary" id="add-detail">Tambah Barang</button>
</div>

<div id="detail-container">
    <?php foreach ($modelFakturDetail as $index => $detail): ?>
        <div class="card mb-3 detail-item">
            <div class="card-body">
                <?= Html::dropDownList(
                    "FakturDetail[$index][barang_id]",
                    $detail->barang_id,
                    ArrayHelper::map(Barang::find()->all(), 'id', 'nama_barang'),
                    ['class' => 'form-control', 'prompt' => 'Pilih Barang']
                ) ?>
                <br>
                <?= Html::input('number', "FakturDetail[$index][qty_barang]", $detail->qty_barang, ['class' => 'form-control', 'placeholder' => 'Quantity']) ?>
                <br>
                <?= Html::textarea("FakturDetail[$index][deskripsi]", $detail->deskripsi, ['class' => 'form-control', 'placeholder' => 'Deskripsi']) ?>
                <br>
                <button type="button" class="btn btn-danger btn-sm remove-item">Hapus</button>
            </div>
        </div>
    <?php endforeach; ?>
</div>

<br>

<div class="row">
    <div class="col-md-12 text-center">
        <?= Html::submitButton('Update Faktur', ['class' => 'btn btn-success btn-lg']) ?>
    </div>
</div>

<?php ActiveForm::end(); ?>

<?php
$js = <<<JS
let index = $('#detail-container .detail-item').length;
$('#add-detail').click(function(){
    let html = `
    <div class="card mb-3 detail-item">
        <div class="card-body">
            <select name="FakturDetail[` + index + `][barang_id]" class="form-control">
                ` + $('#detail-container select:first').html().replace('selected', '') + `
            </select><br>
            <input type="number" name="FakturDetail[` + index + `][qty_barang]" class="form-control" placeholder="Quantity" value="1"><br>
            <textarea name="FakturDetail[` + index + `][deskripsi]" class="form-control" placeholder="Deskripsi"></textarea><br>
            <button type="button" class="btn btn-danger btn-sm remove-item">Hapus</button>
        </div>
    </div>
    `;
    $('#detail-container').append(html);
    index++;
});

$(document).on('click', '.remove-item', function(){
    $(this).closest('.detail-item').remove();
});
JS;
$this->registerJs($js);
?>
