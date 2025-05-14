<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "faktur".
 *
 * @property int $id
 * @property int $kop_id
 * @property string $nomor_faktur
 * @property string|null $created_at
 * @property string|null $updated_at
 * @property string $nama_kasir
 * @property string $jenis_pembayaran
 * @property string $nama_customer
 * @property string $nomor_telpon_customer
 * @property string|null $alamat_customer
 * @property string $jenis_faktur
 * @property string|null $status
 *
 * @property FakturDetail[] $fakturDetails
 * @property Kop $kop
 */
class Faktur extends \yii\db\ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'faktur';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['alamat_customer'], 'default', 'value' => null],
            [['status'], 'default', 'value' => 'Draft'],
            [['kop_id', 'nomor_faktur', 'nama_kasir', 'jenis_pembayaran', 'nama_customer', 'nomor_telpon_customer', 'jenis_faktur'], 'required'],
            [['kop_id'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['alamat_customer'], 'string'],
            [['nomor_faktur'], 'string', 'max' => 50],
            [['nama_kasir', 'jenis_pembayaran', 'nama_customer', 'jenis_faktur', 'status'], 'string', 'max' => 100],
            [['nomor_telpon_customer'], 'string', 'max' => 20],
            [['kop_id'], 'exist', 'skipOnError' => true, 'targetClass' => Kop::class, 'targetAttribute' => ['kop_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'kop_id' => 'Kop ID',
            'nomor_faktur' => 'Nomor Faktur',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'nama_kasir' => 'Nama Kasir',
            'jenis_pembayaran' => 'Jenis Pembayaran',
            'nama_customer' => 'Nama Customer',
            'nomor_telpon_customer' => 'Nomor Telpon Customer',
            'alamat_customer' => 'Alamat Customer',
            'jenis_faktur' => 'Jenis Faktur',
            'status' => 'Status',
        ];
    }

    /**
     * Gets query for [[FakturDetails]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getFakturDetails()
    {
        return $this->hasMany(FakturDetail::class, ['faktur_id' => 'id']);
    }

    /**
     * Gets query for [[Kop]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getKop()
    {
        return $this->hasOne(Kop::class, ['id' => 'kop_id']);
    }

}
