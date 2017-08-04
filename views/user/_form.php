<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\User */
/* @var $form yii\widgets\ActiveForm */
?>
<div class="row">
    <div class="col-lg-8 col-lg-offset-2">
        <div class="card">
            <div class="header">
                <h4 class="title">Form User</h4>
                <?php if ($model->isNewRecord) : ?>
                    <h5 class="label label-danger category"><?= Yii::t('app', 'Silahkan mendaftar user dan password baru untuk melanjutkan') ?></h5>
                <?php endif; ?>
            </div>
            <div class="content">
                <?php $form = ActiveForm::begin(['action' => ['/user/create']]); ?>

                <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

                <?= $form->field($model, 'username')->textInput(['maxlength' => true]) ?>

                <?= $form->field($model, 'password')->passwordInput(['maxlength' => true]) ?>

                <?= $form->field($model, 'verifyNewPassword')->passwordInput(['maxlength' => true]) ?>

                <?php // $form->field($model, 'img')->fileInput(['maxlength' => true]) ?>


                <div class="form-group">
                    <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
                </div>

                <?php ActiveForm::end(); ?>
            </div>
        </div>
    </div>
</div>



