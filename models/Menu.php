<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "menu".
 *
 * @property int $id
 * @property string|null $kode_menu
 * @property string $nama_menu
 * @property string|null $deskripsi
 * @property float $harga
 * @property string|null $gambar
 * @property int|null $stok
 * @property string|null $status
 * @property int|null $kategori_id
 * @property int|null $satuan_id
 *
 * @property Kategori $kategori
 * @property SatuanBarang $satuan
 */
class Menu extends \yii\db\ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'menu';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['kode_menu', 'deskripsi', 'gambar', 'status', 'kategori_id', 'satuan_id'], 'default', 'value' => null],
            [['stok'], 'default', 'value' => 0],
            [['nama_menu', 'harga'], 'required'],
            [['deskripsi'], 'string'],
            [['harga'], 'number'],
            [['stok', 'kategori_id', 'satuan_id'], 'integer'],
            [['kode_menu'], 'string', 'max' => 50],
            [['nama_menu', 'gambar', 'status'], 'string', 'max' => 255],
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
            'kode_menu' => 'Kode Menu',
            'nama_menu' => 'Nama Menu',
            'deskripsi' => 'Deskripsi',
            'harga' => 'Harga',
            'gambar' => 'Gambar',
            'stok' => 'Stok',
            'status' => 'Status',
            'kategori_id' => 'Kategori ID',
            'satuan_id' => 'Satuan ID',
        ];
    }

    /**
     * Gets query for [[Kategori]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getKategori()
    {
        return $this->hasOne(Kategori::class, ['id' => 'kategori_id']);
    }

    /**
     * Gets query for [[Satuan]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSatuan()
    {
        return $this->hasOne(SatuanBarang::class, ['id' => 'satuan_id']);
    }

    public function getHargaFormatted()
    {
        return 'Rp ' . number_format($this->harga, 0, ',', '.');
    }
}
