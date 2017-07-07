<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\User */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Users'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="row">
    <div class="col-lg-8 col-lg-offset-2">
        <div class="card">
            <div class="header">
                <div class="title">
                    <h3><?= Html::encode($this->title) ?></h3>
                </div>
                <div class="category">
                    <p>
                        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary btn-sm']) ?>
                        <?= Html::a(Yii::t('app', 'Ganti Password'), ['change-password', 'id' => $model->id], ['class' => 'btn btn-primary btn-sm']) ?>
                        <?=
                        Html::a(Yii::t('app', 'Reset Akun'), ['reset-account', 'id' => $model->id], [
                            'class' => 'btn btn-danger btn-sm',
                            'data' => [
                                'confirm' => Yii::t('app', 'Apa anda yakin akan mereset ulang akun? (Akun anda tidak akan bisa digunakan kembali!)'),
                                'method' => 'post',
                            ],
                        ])
                        ?>
                    </p>
                </div>
            </div>
            <div class="content">
                <?=
                DetailView::widget([
                    'model' => $model,
                    'attributes' => [
                        'name',
                        'username',
//                        'password',
                        [
                            'label' => 'isActive',
                            'type' => 'raw',
                            'value' => function($model) {
                                return $model->isActive == '1' ? '<span class="badge">true</span>' : '<span class="badge">false</span>';
                            }
                        ]
                    ],
                ])
                ?>
            </div>
        </div>
    </div>
</div>
