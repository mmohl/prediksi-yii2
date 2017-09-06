<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace app\models;

use Yii;
use app\helpers\MySession;

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
    public $teknik;
    private $source;
    private $isCalculated = false;

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

    public function isPredictionYear() {

        return $this->tahun === date('Y');
    }

    public function checkYear($attribute, $params, $validator) {
        $year = intval(date('Y'));
        $firstYear = Penjualan::find()->orderBy(['tahun' => SORT_ASC])->one();

        if (empty($firstYear)) {
            $this->addError($attribute, \Yii::t('app', 'tidak ada data penjualan. silahkan import data.'));
            return;
        }

        if ($this->{$attribute} > $year) {
            $this->addError($attribute, \Yii::t('app', $attribute . " tidak boleh lebih dari " . $year));
        } elseif ($this->{$attribute} < $firstYear->tahun) {
            $this->addError($attribute, \Yii::t('app', $attribute . ' tidak boleh kurang dari ' . $firstYear->tahun));
        }
    }

    public function getStatus() {
        return $this->isCalculated;
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

        $this->isCalculated = true;

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

    public function getNextYear() {
        $months = Prediksi::getMonths();
        $x = end($this->source)['x'];
        $data = [];

        $i = 0;
        foreach ($months as $key => $value) {
            $row = ['bulan' => $key];

            $this->isOdd === true ? $i += 1 : $i += 2;

            $row['x'] = $x + $i;

            $data[] = $row;
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

    /**
     * Fungsi untuk memanggil data hasil prediksi.
     * @param boolean $order
     * @return array
     */
    public function getPrediction() {
        $datas = [];
        $liniers = $this->getLiniers();
        $next = $this->getNextYear();

        // Jika prediksi sudah pernah dilakukan untuk tahun mendatang, maka ambil dari session.
        if (Yii::$app->session->has(MySession::getOnePredictionKey()) && $this->tahun === date('Y')) {
            return Yii::$app->session->get(MySession::getOnePredictionKey());
        }

        /**
         * Menjumlahkan value tiap teknik
         */
        foreach ($next as $row) {
            $datas[$row['bulan']] = [];
            foreach ($liniers as $key => $values) {
                $datas[$row['bulan']][$key] = round($values[1] + ($values[2] * $row['x']));
            }
        }

        /**
         * Menyimpan hasil prediksi ke session
         */
        if ($this->tahun === date('Y')) {
            MySession::saveToSession(MySession::getOnePredictionKey(), $datas);
        }

        return $datas;
    }

    public function getMadAndMse() {
        $teknik = Teknik::find()->where(['id' => 2])->one();
        $prediction = $this->getPrediction();
        $lists = [];
        $totalPenjualan = $this->countSales($teknik->id, $this->tahun);
        $total = [];
        $included = ['error', 'errorKw', 'selisih'];

        foreach ($prediction as $month => $datas) {
            $penjualan = $totalPenjualan[$month];
            $forecase = $datas[$teknik->kode];
            $error = abs(round($penjualan - $forecase));

            $tmp = [
                'penjualan' => $penjualan,
                'forecase' => $forecase,
                'error' => $error,
                'errorKw' => pow($error, 2),
                'selisih' => round(($error / $penjualan) * 100)
            ];

            $lists[$month] = $tmp;
        }

        $tmp = $lists;

        foreach ($lists as $lists) {
            foreach ($lists as $key => $val) {
                if (in_array($key, $included)) {
                    array_key_exists($key, $total) ? $total[$key] += $val : $total[$key] = $val;
                }
            }
        }

        $errors = [
            'mad' => round($total['error'] / 12),
            'mse' => round($total['errorKw'] / 12),
            'selisih' => round($total['selisih'] / 12)
        ];

        return ['prediction' => $tmp, 'total' => $total, 'errorPrediction' => $errors];
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

    private function countSales($teknik, $year) {
        $holder = [];
        $keys = [];
        $groups = Penjualan::find()->select(['id_teknik', 'bulan', 'jumlah'])->where(['=', 'tahun', $year])->asArray()->all();

        foreach ($groups as $group) {
            $key = $group['bulan'];

            if (!in_array($group['bulan'], $keys)) {
                $keys[] = $key;
                $holder[strtolower($key)] = 0;
            }

            if (intval($group['id_teknik']) === $teknik) {
                $holder[strtolower($key)] += intval($group['jumlah']);
            }
        }

        return $holder;
    }

}
