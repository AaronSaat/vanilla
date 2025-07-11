<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "pesanan".
 *
 * @property int $id
 * @property string $kode_pesanan
 * @property string $created_at
 * @property string $updated_at
 * @property string|null $nomor_meja
 * @property string|null $nama_customer
 * @property string|null $nomor_telpon_customer
 * @property string|null $alamat_customer
 * @property float $total_harga
 * @property string|null $status
 * @property string|null $catatan
 * @property string|null $nama_kasir
 * @property string|null $jenis_pembayaran
 * @property string|null $waktu_selesai
 * @property float|null $diskon_total
 * @property float|null $service_charge
 * @property float|null $ppn
 *
 * @property PesananDetail[] $pesananDetails
 */
class Pesanan extends \yii\db\ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'pesanan';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nomor_meja', 'nama_customer', 'nomor_telpon_customer', 'alamat_customer', 'status', 'catatan', 'nama_kasir', 'jenis_pembayaran', 'waktu_selesai'], 'default', 'value' => null],
            [['ppn'], 'default', 'value' => 0.00],
            [['kode_pesanan', 'total_harga'], 'required'],
            [['created_at', 'updated_at', 'waktu_selesai'], 'safe'],
            [['total_harga', 'diskon_total', 'service_charge', 'ppn'], 'number'],
            [['catatan'], 'string'],
            [['kode_pesanan', 'nama_customer', 'nama_kasir'], 'string', 'max' => 100],
            [['nomor_meja'], 'string', 'max' => 10],
            [['nomor_telpon_customer'], 'string', 'max' => 20],
            [['alamat_customer', 'status'], 'string', 'max' => 255],
            [['jenis_pembayaran'], 'string', 'max' => 30],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'kode_pesanan' => 'Kode Pesanan',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'nomor_meja' => 'Nomor Meja',
            'nama_customer' => 'Nama Customer',
            'nomor_telpon_customer' => 'Nomor Telpon Customer',
            'alamat_customer' => 'Alamat Customer',
            'total_harga' => 'Total Harga',
            'status' => 'Status',
            'catatan' => 'Catatan',
            'nama_kasir' => 'Nama Kasir',
            'jenis_pembayaran' => 'Jenis Pembayaran',
            'waktu_selesai' => 'Waktu Selesai',
            'diskon_total' => 'Diskon Total',
            'service_charge' => 'Service Charge',
            'ppn' => 'Ppn',
        ];
    }

    /**
     * Gets query for [[PesananDetails]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPesananDetails()
    {
        return $this->hasMany(PesananDetail::class, ['pesanan_id' => 'id']);
    }

}
