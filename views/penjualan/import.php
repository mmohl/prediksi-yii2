<?php

use yii\widgets\ActiveForm;
use yii\helpers\Html;

$this->title = Yii::t('app', 'Import');
$this->params['breadcrumbs'][] = $this->title;

if (!empty($flash)) {
    echo $flash;
}
?>
<div class="row">
    <div class="col-lg-8 col-lg-offset-2">
        <div class="card">
            <div class="header">
                <div class="title">
                    <h3>Form Import</h3>
                </div>
                <div class="category"><span>File Format .CSV</span></div>
            </div>
            <div class="content">
                <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]) ?>

                <?= $form->field($model, 'excel')->fileInput(['class' => 'form-control']) ?>

                <div class="form-group">
                    <?= Html::submitButton('Submit', ['class' => 'btn btn-primary']) ?>
                </div>

                <?php ActiveForm::end() ?>
            </div>
        </div>
    </div>
</div>


