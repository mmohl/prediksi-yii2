<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace app\models;

use SimpleExcel\SimpleExcel as Excel;
use yii\helpers\FileHelper as File;

/**
 * Description of Data
 *
 * @author mmohl
 */
class Data extends \yii\base\Model {

    public $excel;

    public function rules() {
        return [
            [['excel'], 'required'],
            [['excel'], 'file', 'extensions' => ['csv']]
        ];
    }

    public function attributeLabels() {
        return [
            'excel' => \Yii::t('app', 'File')
        ];
    }

    public function import($path) {
        $import = new Excel('CSV');

        $data = $import->convertTo('JSON');

        var_dump($data);
        die;
    }

    private function saveFile() {

    }

}
