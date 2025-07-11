<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "pesanan_detail".
 *
 * @property int $id
 * @property int $pesanan_id
 * @property int $menu_id
 * @property int $qty_menu
 * @property string|null $deskripsi
 *
 * @property Menu $menu
 * @property Pesanan $pesanan
 */
class PesananDetail extends \yii\db\ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'pesanan_detail';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['deskripsi'], 'default', 'value' => null],
            [['pesanan_id', 'menu_id', 'qty_menu'], 'required'],
            [['pesanan_id', 'menu_id', 'qty_menu'], 'integer'],
            [['deskripsi'], 'string'],
            [['pesanan_id'], 'exist', 'skipOnError' => true, 'targetClass' => Pesanan::class, 'targetAttribute' => ['pesanan_id' => 'id']],
            [['menu_id'], 'exist', 'skipOnError' => true, 'targetClass' => Menu::class, 'targetAttribute' => ['menu_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'pesanan_id' => 'Pesanan ID',
            'menu_id' => 'Menu ID',
            'qty_menu' => 'Qty Menu',
            'deskripsi' => 'Deskripsi',
        ];
    }

    /**
     * Gets query for [[Menu]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMenu()
    {
        return $this->hasOne(Menu::class, ['id' => 'menu_id']);
    }

    /**
     * Gets query for [[Pesanan]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPesanan()
    {
        return $this->hasOne(Pesanan::class, ['id' => 'pesanan_id']);
    }

}
