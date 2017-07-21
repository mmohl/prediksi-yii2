<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel app\models\searches\TeknikSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Teknik');
$this->params['breadcrumbs'][] = $this->title;
?>


<div class="table-responsive">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="header">
                    <h3 class="title"><?= Html::encode($this->title) ?></h3>
                    <p class="category">
                        <?= Html::a(Yii::t('app', 'Create Teknik'), ['create'], ['class' => 'btn btn-success']) ?>
                    </p>
                </div>
                <div class="content">

                    <?php // echo $this->render('_search', ['model' => $searchModel]);  ?>


                    <?php Pjax::begin(); ?>
                    <?=
                    GridView::widget([
                        'dataProvider' => $dataProvider,
                        'filterModel' => $searchModel,
                        'columns' => [
                            ['class' => 'yii\grid\SerialColumn'],
                            ['label' => 'Parent', 'value' => 'key.kode'],
                            'nama_teknik',
                            'kode',
                            ['class' => 'yii\grid\ActionColumn'],
                        ],
                    ]);
                    ?>
                    <?php Pjax::end(); ?>
                </div>
            </div>
        </div>
    </div>
</div>
