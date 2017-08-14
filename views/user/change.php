<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

use yii\helpers\Html;

$this->params['breadcrumbs'][] = Yii::t('app', ucwords('ganti passwords'));
?>

<div class="row">
    <div class="col-lg-8 col-lg-offset-2">
        <!-- Card -->
        <div class="card">
            <div class="header">
                <h4 class="title"><?= Yii::t('app', 'Ganti Password') ?></h4>
            </div>
            <div class="content">
                <?= Html::beginForm('', 'POST') ?>
                <div class="form-group">
                    <?= Html::label(Yii::t('app', 'Password Baru')) ?>
                    <?= Html::activeInput('text', $model, 'newPassword', ['class' => 'form-control']) ?>
                </div>
                <div class="form-group">
                    <?= Html::label(Yii::t('app', 'Verifikasi Password Baru')) ?>
                    <?= Html::activeInput('text', $model, 'verifyNewPassword', ['class' => 'form-control']) ?>
                </div>
                <div class="form-group">
                    <?= Html::submitButton('Submit', ['class' => 'btn btn-primary']) ?>
                </div>
                <?= Html::endForm() ?>
            </div>
        </div>
        <!-- End Card -->
    </div>
</div>
