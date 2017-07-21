<?php
$this->title = Yii::t('app', 'Prediksi');
$this->params['breadcrumbs'][] = $this->title;

use yii\bootstrap\ActiveForm;
use yii\bootstrap\Html;

if ($model->getStatus()) {
    $sources = $model->getSources();
    $headers = $model->getHeaders();
    $footers = $model->getFooters();
    $predictions = $model->getPrediction();
    $next = $model->getNextMonth();
    $highest = $model->getHighest(true);
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
    <?php if (!empty($sources) && !empty($headers)): ?>
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
                <?= $highest['label'] ?> tertinggi, dengan nilai <h5 class="label label-primary"><?= $highest['value'] ?></h5>
            </div>
            <div class="category">
                Hasil Prediksi untuk bulan <?= $next['bulan'] ?> <?= $next['tahun'] ?>
            </div>
        </div>
        <div class="content">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Tahun</th>
                        <th>Bulan</th>
                        <?php foreach ($predictions as $key => $value) : ?>
                            <?= Html::tag('th', $key) ?>
                        <?php endforeach; ?>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><?= $next['tahun'] ?></td>
                        <td><?= $next['bulan'] ?></td>
                        <?php foreach ($predictions as $key => $value) : ?>
                            <?= Html::tag('td', $value) ?>
                        <?php endforeach; ?>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

<?php endif; ?>
