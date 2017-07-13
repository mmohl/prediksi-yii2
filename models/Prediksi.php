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
    private $source;

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
        $tmp = null;
        $this->isOdd = count($source) % 2 == 1 ? true : false;

        if ($this->isOdd) {
            $tmp = $this->isOdd($source);
        } else {
            $tmp = $this->isEven($source);
        }

        $this->source = $this->countKwadrat($tmp);
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

    public function getHeaders() {
        $data = [];
        foreach ($this->source[0] as $key => $value) {
            $data[] = $key;
        }

        return $data;
    }

    public function getSources() {
        return $this->source;
    }

    public function getFooters() {
        $headers = $this->getHeaders();
        $data = [];

        for ($k = 2; $k < count($headers); $k++) {
            $total = 0;
            foreach ($this->source as $sourc) {
                $total = $total + $sourc[$headers[$k]];
            }
            $data[$headers[$k]] = $total;
        }

        return $data;
    }

    public function getNextMonth() {
        $months = Prediksi::getMonths();
        $last = end($this->source);
        $data = null;

        if (strtolower($last['bulan']) === 'desember') {
            $data['tahun'] = intval($last['tahun']) + 1;
            $data['bulan'] = 'januari';
        } else {
            array_search($months[strtolower($last['bulan'])] + 1, $months);
        }

        if ($this->isOdd) {
            $data['x'] = $last['x'] + 1;
        } else {
            $data['x'] = $last['x'] + 2;
        }

        return $data;
    }

    public function getLiniers() {
        $datas = [];
        $total = count($this->source);
        $footers = $this->getFooters();
        $kwadrat = $footers['x2'];
        $excludes = ['x2', 'x'];

        foreach ($footers as $key => $value) {
            if (!in_array($key, $excludes)) {
                if (substr($key, 0, 1) === 'x') {
                    $datas[substr($key, 1, strlen($key))]['2'] = $value / $kwadrat;
                } else {
                    $datas[$key]['1'] = $value / $total;
                }
            }
        }

        return $datas;
    }

    public function getPrediction($order = false) {
        $datas = [];
        $liniers = $this->getLiniers();
        $next = $this->getNextMonth();

        foreach ($liniers as $key => $values) {
            $datas[$key] = round($values[1] + ($values[2] * $next['x']));
        }

        if ($order) {
            uasort($datas, [$this, 'cmp']);
            return $datas;
        }

        return $datas;
    }

    public function getHighest($labeled = false) {

        if ($labeled) {

            $tot = $this->getPrediction(true);
            $keys = array_keys($tot);
            $highest = max($tot);

            return ['value' => $highest, 'label' => $keys[count($keys) - 1]];
        }

        return max($this->getPrediction());
    }

    public function getLowest($labeled = false) {
        if ($labeled) {
            $tot = $this->getPrediction(true);
            $keys = array_keys($tot);
            $lowest = min($tot);

            return ['value' => $lowest, 'label' => $keys[0]];
        }

        return min($this->getPrediction());
    }

    private function cmp($a, $b) {
        if ($a == $b) {
            return 0;
        }
        return ($a < $b) ? -1 : 1;
    }

    private static function getMonths() {
        return [
            'januari' => 1,
            'februari' => 2,
            'maret' => 3,
            'april' => 4,
            'mei' => 5,
            'juni' => 6,
            'juli' => 7,
            'agustus' => 8,
            'september' => 9,
            'oktober' => 10,
            'november' => 11,
            'desember' => 12
        ];
    }

}
