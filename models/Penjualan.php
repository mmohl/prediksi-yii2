<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "penjualan".
 *
 * @property integer $id
 * @property integer $id_teknik
 * @property string $tahun
 * @property string $bulan
 * @property integer $jumlah
 * @property integer index
 */
class Penjualan extends Model {

    public $index;
    public $kwadrat;

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'penjualan';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['id_teknik', 'jumlah', 'kwadrat', 'index'], 'integer'],
            [['tahun', 'bulan'], 'required'],
            [['tahun'], 'string', 'max' => 10],
            [['bulan'], 'string', 'max' => 50],
            [['index', 'kwadrat'], 'safe']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'id' => Yii::t('app', 'ID'),
            'id_teknik' => Yii::t('app', 'Id Teknik'),
            'tahun' => Yii::t('app', 'Tahun'),
            'bulan' => Yii::t('app', 'Bulan'),
            'jumlah' => Yii::t('app', 'Jumlah'),
            'index' => \Yii::t('app', 'Index')
        ];
    }

    public function setIndex($value) {
        $this->index = $value;
    }

    public function getIndex() {
        return $this->index;
    }

    public static function getAllYears($limit = null) {

        $tmp = Penjualan::find()->select(['tahun'])->distinct();

        if (!empty($limit)) {
            $tmp->where(['<', 'tahun', $limit]);
        }

        $years = $tmp->asArray()->all();

        return array_map(function($year) {
            return $year['tahun'];
        }, $years);
    }

    public static function getMonths() {
        return [
            'Januari',
            'Februari',
            'Maret',
            'April',
            'Mei',
            'Juni',
            'Juli',
            'Agustus',
            'September',
            'Oktober',
            'November',
            'Desember'
        ];
    }

}
