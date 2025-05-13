<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "satuan_barang".
 *
 * @property int $id
 * @property string $satuan
 * @property string|null $keterangan
 * @property string|null $contoh_barang
 */
class SatuanBarang extends \yii\db\ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'satuan_barang';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['keterangan', 'contoh_barang'], 'default', 'value' => null],
            [['satuan'], 'required'],
            [['satuan'], 'string', 'max' => 20],
            [['keterangan'], 'string', 'max' => 100],
            [['contoh_barang'], 'string', 'max' => 200],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'satuan' => 'Satuan',
            'keterangan' => 'Keterangan',
            'contoh_barang' => 'Contoh Barang',
        ];
    }

}
