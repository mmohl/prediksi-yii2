<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$this->title = ucfirst(Yii::t('app', 'chart'));

$data = ['Teknik A' => 'Teknik A', 'Teknik B' => 'Teknik B', 'Teknik C' => 'Teknik C'];

use kartik\select2\Select2;
use dosamigos\chartjs\ChartJs;
use yii\helpers\Html;
?>

<!--<div class="row">
    <div class="col-lg-6">-->

<div class="card">
    <div class="header">
        <div class="title">
            <h3>Penjualan Chart</h3>
        </div>
        <?= Html::beginForm('', 'get') ?>
        <div class="row">
            <div class="col-lg-5">
                <?=
                Select2::widget([
                    'theme' => Select2::THEME_BOOTSTRAP,
                    'size' => 'md',
                    'name' => 'teknik',
                    'value' => '',
                    'data' => $data,
                    'pluginOptions' => [
                        'allowClear' => true
                    ],
                    'options' => ['multiple' => true, 'placeholder' => ucwords(Yii::t('app', 'pilih teknik'))]
                ]);
                ?>
<!--                <select class="form-control">
                    <option value="">Teknik A</option>
                    <option value="">Teknik B</option>
                    <option value="">Teknik C</option>
                </select>-->
            </div>
            <div class="col-lg-5">
                <select class="form-control">
                    <option value="">2017</option>
                    <option value="">2016</option>
                    <option value="">2015</option>
                </select>
            </div>
            <div class="col-lg-2">
                <button class="btn btn-primary" type="button">Search</button>
            </div>
        </div>
        <?= Html::endForm() ?>

    </div>
    <div class="content">
        <?=
        ChartJs::widget([
            'type' => 'line',
            'options' => [
                'height' => 200,
                'width' => 600
            ],
            'data' => [
                'labels' => ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"],
                'datasets' => [
                    [
                        'label' => "Teknik A",
                        'backgroundColor' => "rgba(179,181,198,0.2)",
                        'borderColor' => "rgba(179,181,198,1)",
                        'pointBackgroundColor' => "rgba(179,181,198,1)",
                        'pointBorderColor' => "#fff",
                        'pointHoverBackgroundColor' => "#fff",
                        'pointHoverBorderColor' => "rgba(179,181,198,1)",
                        'data' => [65, 59, 90, 81, 56, 55, 40, 95, 19, 80, 41, 90, 56]
                    ]
                ]
            ]
        ]);
        ?>
    </div>
</div>
<!--    </div>
</div>-->

