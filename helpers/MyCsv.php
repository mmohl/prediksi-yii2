<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace app\helpers;

use app\models\Teknik;
use app\models\Penjualan;
use yii\db\Exception;

/**
 * Description of MyCsv
 *
 * @author mmohl
 */
class MyCsv {

    public static function getHeaders(array $headers) {
        $teknik = Teknik::find()->where(['parent' => NULL])->all();

        $values = [];

        $unknowns = [];

        foreach ($headers as $header) {

            if (strtolower($header) === 'tahun' || strtolower($header) === 'bulan') {
                continue;
            } elseif (in_array($teknik, $header)) {
                $values[] = $header;
            } else {
                $unknowns[] = $header;
            }
        }

        return ['headers' => $values, 'unknowns' => $unknowns];
    }

    public static function groups(array $rows) {
        $codes = \app\models\handlers\TeknikHandler::getCodes('array');

        $years = [];
        $kodes = [];

        // group kodes
        foreach ($rows[0] as $key => $kode) {
            if (in_array($kode, $codes)) {
                $kodes[$key] = $kode;
            }
        }

        // group years
        foreach ($rows as $row) {

            if (is_numeric($row[0]) && !in_array($row[0], $years)) {
                $years[$row[0]] = strval($row[0]);
            }
        }

        // group months
        foreach ($years as $year) {
            $months = [];
            foreach ($rows as $row) {
                if (strval($row[0]) == $year) {
                    $months[$row[1]] = $row[1];
                }
            }
            $years[$year] = $months;
        }



        // group value
        $vals = [];
        foreach ($years as $year => $months) {
            foreach ($months as $month) {
                foreach ($kodes as $key => $kode) {
                    foreach ($rows as $row) {
                        if ($row[0] == $year && $row[1] == $month && is_numeric($row[$key])) {
                            $vals[$year][$month][$kode][] = $row[$key];
                        }
                    }
                }
            }
        }


        // join all data
        foreach ($vals as $year => $months) {
            foreach ($months as $month => $kodes) {
                $years[strval($year)][$month] = $kodes;
            }
        }

        return $years;
    }

    public static function insertToDb(array $collection) {
        $conn = \Yii::$app->db;
        $teknik = new Teknik;

        $transaction = $conn->beginTransaction();
        try {
            foreach ($collection as $year => $months) {
                foreach ($months as $month => $kodes) {
                    foreach ($kodes as $kode => $value) {

                        if ($kode != $teknik->kode) {
                            $teknik = Teknik::findOne(['kode' => $kode]);
                        }

                        $old = Penjualan::find()
                                ->where(['tahun' => $year, 'bulan' => $month, 'id_teknik' => $teknik->id, 'jumlah' => $value[0]])
                                ->one();

                        if (empty($old)) {

                            $model = new Penjualan;
                            $model->tahun = $year;
                            $model->bulan = $month;
                            $model->id_teknik = $teknik->id;
                            $model->jumlah = intval($value[0]);

                            $model->save(false);
                        }
                    }
                }
            }

            $transaction->commit();
            return true;
        } catch (Exception $e) {
            var_dump($e->getMessage());
            $transaction->rollBack();
            return false;
        }
    }

}
