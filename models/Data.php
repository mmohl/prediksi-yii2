<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace app\models;

use yii\web\UploadedFile;
use kartik\growl\Growl;
use League\Csv\Reader;

/**
 * Description of Data
 *
 * @author mmohl
 */
class Data extends \yii\base\Model {

    /**
     * @var UploadedFile
     */
    public $excel;
    private $path = __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'uploads';
    private $filename;

    public function rules() {
        return [
            [['excel'], 'required'],
            [['excel', 'path', 'filename'], 'safe'],
            [['excel'], 'file', 'skipOnEmpty' => false],
            [['excel'], 'checkTeknik'],
        ];
    }

    public function attributeLabels() {
        return [
            'excel' => \Yii::t('app', 'File')
        ];
    }

    public function checkTeknik($attribute, $params, $validator) {
        $tekniks = $this->loadTekniks();
        $tmp = $this->fetchData()->fetchAll()[0];
        $onFile = [];

        foreach ($tmp as $title) {
            if (strtolower($title) != 'tahun' && strtolower($title) != 'bulan') {
                $onFile[] = $title;
            }
        }

        asort($onFile);

        $unknowns = [];

        if (empty($tekniks)) {
            $this->addError($attribute, \Yii::t('app', ucwords('tidak ada teknik di database. silahkan buat teknik terlebih dahulu.')));
        } else {
            foreach ($onFile as $title) {
                if (!in_array($title, $tekniks)) {
                    $unknowns[] = $title;
                }
            }

            if (!empty($unknowns)) {
                $this->addError($attribute, \Yii::t('app', count($unknowns) . ' teknik tidak diketahui pada file, ' . join(', ', $unknowns)));
            }
        }
    }

    private function loadTekniks() {
        $data = Teknik::find()->select('kode')->asArray()->all();

        $values = [];
        foreach ($data as $dat) {
            $values[] = $dat['kode'];
        }

        return $values;
    }

    private function fetchData() {
        return Reader::createFromPath($this->getFullPath());
    }

    public function import() {
        $csv = Reader::createFromPath($this->getFullPath());

//        $csv->setDelimiter(',');

        $data = \app\helpers\MyCsv::groups($csv->fetchAll());

        if (\app\helpers\MyCsv::insertToDb($data)) {
            return true;
        } else {
            return false;
        }
    }

    public function upload() {

        $this->filename = $this->excel->baseName . '.' . $this->excel->extension;

        if ($this->validate()) {
            $this->excel->saveAs($this->getFullPath());
            return true;
        } else {
            return false;
        }
    }

    public function getFlash($is) {
        $options = [
            'icon' => 'glyphicon glyphicon-ok-sign',
            'showSeparator' => true,
            'delay' => 1000,
            'pluginOptions' => [
                'showProgressbar' => false,
                'placement' => [
                    'from' => 'top',
                    'align' => 'right',
                ]
            ]
        ];

        $type = $is === true ?
                [
            'type' => Growl::TYPE_SUCCESS,
            'title' => \Yii::t('app', 'Selamat'),
            'body' => \Yii::t('app', 'File berhasil di import')
                ] :
                [
            'type' => Growl::TYPE_DANGER,
            'title' => \Yii::t('app', 'Peringatan'),
            'body' => \Yii::t('app', 'File gagal di import')
        ];

        return Growl::widget(array_merge($options, $type));
    }

    public function getPath() {
        return $this->path;
    }

    public function getFilename() {
        return $this->filename;
    }

    public function getFullPath() {
        return $this->path . DIRECTORY_SEPARATOR . $this->filename;
    }

}
