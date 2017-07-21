<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

use kartik\select2\Select2;
use dosamigos\chartjs\ChartJs;
use yii\helpers\Html;
use yii\widgets\Pjax;

$this->title = Yii::t('app', 'Laporan');
$this->params['breadcrumbs'][] = $this->title;

$this->title = ucfirst(Yii::t('app', 'chart'));

$tekniks = \app\models\handlers\TeknikHandler::getChartFormat();
$years = app\models\Penjualan::getAllYears(NULL, TRUE);
?>

<!--<div class="row">
    <div class="col-lg-6">-->

<?php Pjax::begin() ?>
<div class = "card">
    <div class = "header">
        <div class = "title">
            <h3>Penjualan Chart</h3>
        </div>
        <?= Html::beginForm(['penjualan/chart'], 'GET', ['data-pjax' => TRUE, 'class' => 'form']) ?>
        <div class="row">
            <div class="col-lg-5">
                <?=
                Select2::widget([
                    'theme' => Select2::THEME_BOOTSTRAP,
                    'size' => 'md',
                    'model' => $chart,
                    'attribute' => 'tekniks',
                    'data' => $tekniks,
                    'pluginOptions' => [
                        'allowClear' => true
                    ],
                    'options' => ['multiple' => true, 'placeholder' => ucwords(Yii::t('app', 'pilih teknik'))]
                ]);
                ?>
            </div>
            <div class="col-lg-5">
                <?= Html::activeDropDownList($chart, 'tahun', $years, ['class' => 'form-control']) ?>
            </div>
            <div class="col-lg-2">
                <?= Html::submitButton('Cari', ['class' => 'btn btn-primary']) ?>
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
                'labels' => $chart->getLabels(),
                'datasets' => $chart->getDatasets()
            ]
        ]);
        ?>

    </div>
</div>
<?php Pjax::end() ?>
<!--    </div>
</div>-->

