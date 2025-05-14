<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "faktur_detail".
 *
 * @property int $id
 * @property int $faktur_id
 * @property int $barang_id
 * @property float $qty_barang
 * @property string|null $deskripsi
 *
 * @property Barang $barang
 * @property Faktur $faktur
 */
class FakturDetail extends \yii\db\ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'faktur_detail';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['deskripsi'], 'default', 'value' => null],
            [['qty_barang'], 'default', 'value' => 1.00],
            [['faktur_id', 'barang_id'], 'required'],
            [['faktur_id', 'barang_id'], 'integer'],
            [['qty_barang'], 'number'],
            [['deskripsi'], 'string'],
            [['faktur_id'], 'exist', 'skipOnError' => true, 'targetClass' => Faktur::class, 'targetAttribute' => ['faktur_id' => 'id']],
            [['barang_id'], 'exist', 'skipOnError' => true, 'targetClass' => Barang::class, 'targetAttribute' => ['barang_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'faktur_id' => 'Faktur ID',
            'barang_id' => 'Barang ID',
            'qty_barang' => 'Qty Barang',
            'deskripsi' => 'Deskripsi',
        ];
    }

    /**
     * Gets query for [[Barang]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getBarang()
    {
        return $this->hasOne(Barang::class, ['id' => 'barang_id']);
    }

    /**
     * Gets query for [[Faktur]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getFaktur()
    {
        return $this->hasOne(Faktur::class, ['id' => 'faktur_id']);
    }

}
