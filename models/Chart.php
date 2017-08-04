<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace app\models;

/**
 * Description of Chart
 *
 * @author mmohl
 */
class Chart extends \yii\base\Model {

    public $tahun = [];
    public $teknik = null;
    private $chart;

    public function attributeLabels() {
        return [
            'tahun' => \Yii::t('app', 'Tahun'),
            'teknik' => \Yii::t('app', 'Teknik')
        ];
    }

    public function rules() {
        return [
            [['tahun', 'teknik'], 'safe']
        ];
    }

    public function getChart() {
        return Penjualan::getReport($this->tahun, $this->teknik);
    }

    public function getLabels() {
        return $this->getChart()['labels'];
    }

    public function getDatasets() {
        return $this->getChart()['datasets'];
    }

}
