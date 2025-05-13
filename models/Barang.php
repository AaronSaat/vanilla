<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "barang".
 *
 * @property int $id
 * @property int|null $kategori_id
 * @property int|null $satuan_id
 * @property string $kode_barang
 * @property string $nama_barang
 * @property string|null $deskripsi
 * @property float $harga
 * @property int|null $diskon
 * @property int $stok
 *
 * @property Kategori $kategori
 * @property SatuanBarang $satuan
 */
class Barang extends \yii\db\ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'barang';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['kategori_id', 'satuan_id', 'deskripsi'], 'default', 'value' => null],
            [['diskon'], 'default', 'value' => 0],
            [['kategori_id', 'satuan_id', 'stok'], 'integer'],
            [['kode_barang', 'nama_barang', 'harga', 'stok'], 'required'],
            [['deskripsi'], 'string'],
            [['harga', 'diskon'], 'number'],
            [['kode_barang'], 'string', 'max' => 50],
            [['nama_barang'], 'string', 'max' => 255],
            [['kode_barang'], 'unique'],
            [['kategori_id'], 'exist', 'skipOnError' => true, 'targetClass' => Kategori::class, 'targetAttribute' => ['kategori_id' => 'id']],
            [['satuan_id'], 'exist', 'skipOnError' => true, 'targetClass' => SatuanBarang::class, 'targetAttribute' => ['satuan_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'kategori_id' => 'Kategori',
            'satuan_id' => 'Satuan',
            'kode_barang' => 'Kode Barang',
            'nama_barang' => 'Nama Barang',
            'deskripsi' => 'Deskripsi',
            'harga' => 'Harga',
            'diskon' => 'Diskon',
            'stok' => 'Stok',
        ];
    }

    public function getKategori()
    {
        return $this->hasOne(Kategori::class, ['id' => 'kategori_id']);
    }

    public function getSatuan()
    {
        return $this->hasOne(SatuanBarang::class, ['id' => 'satuan_id']);
    }

    public function getHargaFormatted()
    {
        return 'Rp ' . number_format($this->harga, 0, ',', '.');
    }
    public function getDiskonFormatted()
    {
        return $this->diskon . '%';
    }

    public function getHargaSetelahDiskonFormatted()
    {
        $hargaSetelahDiskon = $this->harga - ($this->harga * $this->diskon / 100);
        return 'Rp ' . number_format($hargaSetelahDiskon, 0, ',', '.');
    }
}
