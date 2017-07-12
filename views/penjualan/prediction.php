<?php

use yii\bootstrap\ActiveForm;
use yii\bootstrap\Html;
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
                            <?php for ($k = 2; $k < count($headers); $k++): ?>
                                <td>
                                    <?php
                                    $total = 0;
                                    foreach ($sources as $source) {
                                        $total = $total + $source[$headers[$k]];
                                    }
                                    echo $total;
                                    ?>
                                </td>
                            <?php endfor; ?>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

<?php endif; ?>
