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

    public static function getAllYears($limit = null, $dropdown = false) {

        $tmp = Penjualan::find()->select(['tahun'])->distinct();

        if (!empty($limit)) {
            $tmp->where(['<', 'tahun', $limit]);
        }

        $years = $tmp->asArray()->all();

        if ($dropdown) {

            $lists = [];
            foreach ($years as $year) {
                $lists[$year['tahun']] = $year['tahun'];
            }

            return $lists;
        }

        return array_map(function($year) {
            return $year['tahun'];
        }, $years);
    }

    public static function getMonths($useIndex = false) {

        $months = [
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

        if ($useIndex) {
            $tmp = [];

            foreach ($months as $month) {
                $tmp[$month] = $month;
            }

            return $tmp;
        }

        return $months;
    }

    public function getTeknik() {
        return $this->hasOne(Teknik::className(), ['id' => 'id_teknik']);
    }

    public static function getReport($tahun = [], $teknik = null) {

        if (empty($tahun)) {
            return ['labels' => [], 'datasets' => []];
        }

        $values = [];

        /**
         * Untuk set label di chart
         */
        $labels = self::getMonths();

        /**
         * Loop tahun untuk diambil data dari db
         */
        foreach ($tahun as $y) {
            $data = Penjualan::find()
                    ->select(['bulan', 'jumlah'])
                    ->where(['tahun' => $y])
                    ->andWhere(['id_teknik' => $teknik])
                    ->asArray()
                    ->all();

            $values[] = self::toChartJsFormat($data, $y);
        }

        return ['labels' => $labels, 'datasets' => $values];
    }

    private static function toChartJsFormat(array $source, $label) {

        $set = [
            'label' => $label,
            'backgroundColor' => "rgba(" . rand(1, 200) . ", " . rand(1, 200) . ", " . rand(1, 200) . ",0.2)",
            'borderColor' => "rgba(" . rand(1, 200) . ", " . rand(1, 200) . "," . rand(1, 200) . ",1)",
            'pointBackgroundColor' => "rgba(179,181,198,1)",
            'pointBorderColor' => "#fff",
            'pointHoverBackgroundColor' => "#fff",
            'pointHoverBorderColor' => "rgba(179,181,198,1)",
            'data' => array_map(function($month) {
                        return $month['jumlah'];
                    }, $source)
        ];

        return $set;
    }

}
