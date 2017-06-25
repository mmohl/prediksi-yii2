<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "teknik_penjualan".
 *
 * @property integer $id
 * @property string $nama_teknik
 * @property integer $parent
 * @property string $kode
 * @property string $created_at
 * @property string $updated_at
 */
class Teknik extends Model {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'teknik_penjualan';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['nama_teknik', 'parent', 'kode'], 'required'],
            [['parent'], 'integer'],
            [['nama_teknik'], 'string', 'max' => 100],
            [['kode'], 'string', 'max' => 5],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'id' => Yii::t('app', 'ID'),
            'nama_teknik' => Yii::t('app', 'Nama Teknik'),
            'parent' => Yii::t('app', 'Parent'),
            'kode' => Yii::t('app', 'Kode'),
            'created_at' => Yii::t('app', 'Created'),
            'updated_at' => Yii::t('app', 'Updated')
        ];
    }

}
