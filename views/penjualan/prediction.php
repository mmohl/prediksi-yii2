<?php

use yii\bootstrap\ActiveForm;
use yii\bootstrap\Html;
use yii\widgets\Pjax;

// register scripts and assets in here. Because only used in here.
$this->registerCssFile('@web/css/penjualan/dataTables.bootstrap.min.css', ['depends' => [yii\bootstrap\BootstrapAsset::className()]]);
$this->registerJsFile('@web/scripts/penjualan/jquery.dataTables.min.js', ['depends' => [yii\web\JqueryAsset::className()]]);
$this->registerJsFile('@web/scripts/penjualan/dataTables.bootstrap.min.js', ['depends' => [yii\web\JqueryAsset::className()]]);
$this->registerJsFile('@web/scripts/penjualan/chart.js', ['depends' => [yii\web\JqueryAsset::className()]]);

$this->title = Yii::t('app', 'Prediksi');
$this->params['breadcrumbs'][] = $this->title;

$status = $model->getStatus();
if ($status) {
    $sources = $model->getSources();
    $headers = $model->getHeaders();
    $footers = $model->getFooters();
    $predictions = $model->getPrediction();
    $tekniks = \app\models\handlers\TeknikHandler::getChartFormat();
    $datas = $model->isPredictionYear() ? null : $model->getMadAndMse();
}
?>

<div class="card table-full-width table-responsive">
    <div class="header">
        <div class="row">
            <div class="col-lg-6">
                <div class="form-group">
                    <label for="total">Total Records</label>
                    <?= Html::input('text', 'total', empty($sources) ? 0 : count($sources), ['class' => 'form-control', 'readonly' => true]) ?>
                </div>
            </div>
            <div class="col-lg-6">
                <?php $form = ActiveForm::begin() ?>
                <div class="form-group">
                    <?=
                    $form->field($model, 'tahun', [
                        'inputTemplate' => '<div class="input-group">'
                        . '<span class="input-group-btn">'
                        . '<button class="btn btn-primary" type="submit">Prediksi</button>'
                        . '</span>{input}</div>',
                    ])->textInput(['class' => 'form-control', 'placeholder' => Yii::t('app', 'masukan tahun prediksi')]);
                    ?>
                </div>
                <?php ActiveForm::end() ?>
            </div>
        </div>
    </div>
    <?php if ($status): ?>
        <div class="panel">
            <div class="panel-heading">
                <table class="table table-bordered table-condensed">
                    <thead>
                        <tr>
                            <?php foreach ($headers as $header) : ?>
                                <?= Html::tag('th', $header) ?>
                            <?php endforeach; ?>
                        </tr>
                    </thead>
                </table>
            </div>
            <div class="panel-body" style="max-height: 400px; overflow-y: scroll">
                <table class="table table-condensed table-bordered">
                    <tbody style="max-height: 100px; overflow-y: scroll;">
                        <?php foreach ($sources as $source) : ?>
                            <tr>
                                <?php foreach ($source as $column) : ?>
                                    <?= Html::tag('td', $column) ?>
                                <?php endforeach; ?>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
            <div class="panel-footer">
                <table class="table table-bordered">
                    <tbody>
                        <tr>
                            <?= Html::tag('td', Yii::t('app', 'Total'), ['colspan' => 2]) ?>
                            <?php foreach ($footers as $footer): ?>
                                <td>
                                    <?= $footer ?>
                                </td>
                            <?php endforeach; ?>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="header">
            <div class="title">
                <h3><?= Yii::t('app', 'Prediksi untuk tahun ') . $model->tahun ?></h3>
            </div>
            <div class="category">
            </div>
        </div>
        <div class="content">
            <!--Data prediction for every year-->
            <?= $this->render('_prediction', ['predictions' => $predictions]) ?>
        </div>
    </div>

    <!--It will rendered if the year is not prediction year-->
    <?php if (!$model->isPredictionYear()): ?>
        <div class="card">
            <div class="header">
                <h3>Akurasi Penjualan di tahun <?= $model->tahun ?></h3>
            </div>
            <div class="content">
                <?php Pjax::begin() ?>

                <?= $this->render('_accuration', ['datas' => $datas, 'tekniks' => $tekniks]) ?>

                <?php Pjax::end() ?>
            </div>
        </div>
    <?php endif; ?>

<?php endif; ?>
