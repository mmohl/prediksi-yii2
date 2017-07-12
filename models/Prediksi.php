<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace app\models;

/**
 * Description of Prediksi
 *
 * @author mmohl
 */
class Prediksi extends \yii\base\Model {

    public $total;
    public $tahun;
    public $isYear = false;
    public $isOdd;

    public function rules() {
        return [
            [['tahun'], 'required'],
            [['tahun'], 'number'],
            [['tahun'], 'checkYear', 'skipOnEmpty' => false, 'skipOnError' => false],
            [['total'], 'safe']
        ];
    }

    public function attributeLabels() {
        return [
            'tahun' => \Yii::t('app', 'tahun'),
            'total' => \Yii::t('app', 'tahun')
        ];
    }

    public function checkYear($attribute, $params, $validator) {
        $year = intval(date('Y'));
        $firstYear = Penjualan::find()->orderBy(['tahun' => SORT_ASC])->one();

        if ($this->{$attribute} > ($year + 1)) {
            $this->addError($attribute, \Yii::t('app', $attribute . " tidak boleh lebih dari " . ($year + 1)));
        } elseif ($this->{$attribute} < $firstYear->tahun) {
            $this->addError($attribute, \Yii::t('app', $attribute . ' tidak boleh kurang dari ' . $firstYear->tahun));
        }
//        elseif ($this->{$attribute} == $year) {
//            $this->addError($attribute, \Yii::t('app', $attribute . ' tidak boleh sama dengan tahun sekarang'));
//        }
    }

    public function calculate() {
        $source = $this->group($this->getSource($this->tahun));
        $sources = null;

        $this->isOdd = count($source) % 2 == 1 ? true : false;

        if ($this->isOdd) {
            $sources = $this->isOdd($source);
        } else {
            $sources = $this->isEven($source);
        }

        return $this->countKwadrat($sources);
    }

    public function getSource($year) {
        return Penjualan::find()->where(['<', 'tahun', $year])->all();
    }

    private function isOdd($sources) {

        $total = count($sources);
        $mid = ($total - 1) / 2;

        for ($i = 0; $i < $total; $i++) {
            $sources[$i]->index = $i - $mid;
        }

        return $this->countPerTeknik($sources);
    }

    private function isEven($sources) {

        $total = count($sources);

        $mid = $total / 2;

        for ($i = 0; $i < $total; $i++) {
            $sources[$i]['x'] = 2 * ($i - $mid) + 1;
        }

        return $this->countPerTeknik($sources);
    }

    private function countKwadrat($sources) {

        for ($i = 0; $i < count($sources); $i++) {
            $sources[$i]['x2'] = pow($sources[$i]['x'], 2);
        }

        return $sources;
    }

    private function countPerTeknik($sources) {
        $head = handlers\TeknikHandler::getCodes('array');

        $i = 0;
        foreach ($sources as $source) {
            foreach ($source as $key => $value) {
                if (in_array($key, $head)) {
                    $sources[$i]['x' . $key] = $source['x'] * $source[$key];
                }
            }
            $i++;
        }

        return $sources;
    }

    private function group(array $collection) {
        $tmp = Teknik::find()->select(['id', 'kode'])->all();
        $years = Penjualan::getAllYears($this->tahun);
        $kodes = [];
        $months = Penjualan::getMonths();

        foreach ($tmp as $t) {
            $kodes[$t->id] = $t->kode;
        }

        $datas = [];

        foreach ($years as $year) {
            $record['tahun'] = $year;
            foreach ($months as $month) {
                $record['bulan'] = $month;
                foreach ($collection as $col) {
                    if ($col->tahun == $record['tahun'] && $col->bulan == $record['bulan']) {
                        $record[$kodes[$col->id_teknik]] = $col->jumlah;
                    }
                }
                $datas[] = $record;
            }
        }

        return $datas;
    }

}
