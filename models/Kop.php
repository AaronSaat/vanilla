<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "kop".
 *
 * @property int $id
 * @property string|null $logo_toko
 * @property string $nama_toko
 * @property string $nomor_surat_izin_toko
 * @property string $alamat_toko
 * @property string|null $nomor_toko
 * @property string|null $email_toko
 * @property string|null $website_toko
 */
class Kop extends \yii\db\ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'kop';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['logo_toko', 'nomor_toko', 'email_toko', 'website_toko'], 'default', 'value' => null],
            [['nama_toko', 'nomor_surat_izin_toko', 'alamat_toko'], 'required'],
            [['alamat_toko'], 'string'],
            [['logo_toko', 'nama_toko'], 'string', 'max' => 255],
            [['nomor_surat_izin_toko', 'email_toko', 'website_toko'], 'string', 'max' => 100],
            [['nomor_toko'], 'string', 'max' => 50],
            [['nomor_surat_izin_toko'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'logo_toko' => 'Logo Toko',
            'nama_toko' => 'Nama Toko',
            'nomor_surat_izin_toko' => 'Nomor Surat Izin Toko',
            'alamat_toko' => 'Alamat Toko',
            'nomor_toko' => 'Nomor Toko',
            'email_toko' => 'Email Toko',
            'website_toko' => 'Website Toko',
        ];
    }

    public function uploadLogo()
    {
        if ($this->validate(['file_logo'])) {
            $fileName = 'logo_' . time() . '.' . $this->file_logo->extension;
            $this->file_logo->saveAs(Yii::getAlias('@webroot/uploads/') . $fileName);
            $this->logo_toko = '/uploads/' . $fileName;
            return true;
        }
        return false;
    }
}
