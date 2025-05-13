<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\Kategori;
use app\models\SatuanBarang;

/* @var $this yii\web\View */
/* @var $model app\models\Barang */

$this->title = 'Tambah Barang';
$this->params['breadcrumbs'][] = ['label' => 'Master Barang', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

$this->registerJsFile('https://cdn.jsdelivr.net/npm/autonumeric@4.6.0/dist/autoNumeric.min.js', ['depends' => [\yii\web\JqueryAsset::class]]);

$form = ActiveForm::begin(['id' => 'form-id']);
$this->registerJs("
    const hargaInput = new AutoNumeric('#harga-input', {
        currencySymbol: 'Rp ',
        decimalCharacter: ',',
        digitGroupSeparator: '.',
        decimalPlaces: 0,
        unformatOnSubmit: true
    });

    $('#form-id').on('submit', function() {
        var rawValue = hargaInput.getNumber();
        $('#harga-input').val(rawValue);
    });

    setTimeout(function() {
        $('.alert').alert('close');
    }, 5000);
");
?>
<div class="barang-create">

    <div class="card card-primary">
        <div class="card-body">
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

            <?php $form = ActiveForm::begin(); ?>

            <?= $form->field($model, 'kode_barang')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'nama_barang')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'deskripsi')->textarea([
                'rows' => 4,
                'maxlength' => true,
                'placeholder' => 'Isi deskripsi barang (bisa dikosongkan)',
            ])->label('Deskripsi') ?>


            <div class="form-group">
                <label>Harga (Rupiah)</label>
                <input type="text" id="harga-input" name="Barang[harga]" class="form-control" placeholder="Rp 0"
                    value="<?= $model->harga ?>">
            </div>

            <?= $form->field($model, 'diskon')->textInput([
                'type' => 'number',
                'min' => 0,
                'placeholder' => 'Masukkan angka diskon, tanpa desimal, tanpa %',
            ]) ?>

            <?= $form->field($model, 'kategori_id')->dropDownList(
                ArrayHelper::map(Kategori::find()->all(), 'id', 'nama_kategori'),
                ['prompt' => '- Pilih Kategori -']
            ) ?>

            <?= $form->field($model, 'satuan_id')->dropDownList(
                ArrayHelper::map(SatuanBarang::find()->all(), 'id', 'satuan'),
                ['prompt' => '- Pilih Satuan -']
            ) ?>

            <?= $form->field($model, 'stok')->textInput(['type' => 'number', 'min' => 0]) ?>

            <div class="form-group text-center">
                <?= Html::submitButton('<i class="fas fa-save"></i> Simpan', [
                    'class' => 'btn btn-success btn-lg px-5'
                ]) ?>
            </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>

</div>