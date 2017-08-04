<?php
/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Login';
?>

<div class="form">
    <?php $form = ActiveForm::begin(['id' => 'login-form']) ?>
    <!--<div class="forceColor"></div>-->
    <div class="topbar">
        <?= $form->field($model, 'username')->textInput(['class' => 'input', 'placeholder' => 'Username']) ?>
        <div class="spanColor"></div>
        <?= $form->field($model, 'password')->passwordInput(['class' => 'input', 'placeholder' => 'Password']) ?>
    </div>
    <div class="form-group">
        <div class="col-lg-offset-1 col-lg-11">
            <?= Html::submitButton('Login', ['class' => 'submit', 'name' => 'login-button']) ?>
        </div>
    </div>
    <?php ActiveForm::end(); ?>
    <?php var_dump($model->errors) ?>
</div>