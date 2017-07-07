<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use kartik\typeahead\Typeahead;
use yii\helpers\Url;

$this->registerJsFile('@web/scripts/teknik/form.js', ['depends' => [\yii\web\JqueryAsset::className()]])

/* @var $this yii\web\View */
/* @var $model app\models\Teknik */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="row">
    <div class="col-lg-8 col-lg-offset-2">
        <div class="card">
            <div class="header">
                <div class="title">
                    <h3><?= Html::encode($this->title) ?></h3>
                </div>
                <div class="category"></div>
            </div>
            <div class="content">
                <?php $form = ActiveForm::begin(); ?>

                <?= $form->field($model, 'nama_teknik')->textInput(['maxlength' => true, 'class' => 'form-control']) ?>

                <?=
                $form->field($model, 'parent', [
                    'inputTemplate' => '<div class="input-group"><span class="input-group-addon"><input type="checkbox" id="parent-check"></span>{input}</div>',
                ])->widget(Typeahead::classname(), [
                    'dataset' => [
                        [
                            'datumTokenizer' => "Bloodhound.tokenizers.obj.whitespace('value')",
                            'display' => 'value',
                            'remote' => [
                                'url' => Url::to(['teknik/teknik-parents']) . '?q=%QUERY',
                                'wildcard' => '%QUERY'
                            ]
                        ]
                    ],
                    'pluginOptions' => ['highlight' => true],
                    'options' => ['placeholder' => 'Filter as you type ...'],
                ]);
                ?>


                <?= $form->field($model, 'kode')->textInput(['maxlength' => true]) ?>

                <div class="form-group">
                    <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
                </div>

                <?php ActiveForm::end(); ?>
            </div>
        </div>
    </div>
</div>