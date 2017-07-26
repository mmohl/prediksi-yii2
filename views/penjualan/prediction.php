<?php

use yii\bootstrap\ActiveForm;
use yii\bootstrap\Html;

$this->title = Yii::t('app', 'Prediksi');
$this->params['breadcrumbs'][] = $this->title;

if ($model->getStatus()) {
    $sources = $model->getSources();
    $headers = $model->getHeaders();
    $footers = $model->getFooters();
    $predictions = $model->getPrediction();
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
    <?php if ($model->getStatus()): ?>
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
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Bulan</th>
                        <?php foreach ($predictions['januari'] as $key => $value) : ?>
                            <?= Html::tag('th', $key) ?>
                        <?php endforeach; ?>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($predictions as $month => $prediction): ?>
                        <tr>
                            <td><?= ucfirst($month) ?></td>
                            <?php foreach ($prediction as $value): ?>
                                <td><?= $value ?></td>
                            <?php endforeach; ?>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

<?php endif;
?>
