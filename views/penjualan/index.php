<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel app\models\searches\PenjualanSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Penjualan');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="penjualan-index">

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="header">
                    <div class="title">
                        <h3><?= Html::encode($this->title) ?></h3>
                    </div>
                </div>
                <div class="content">
                    <?php Pjax::begin(); ?>    <?=
                    GridView::widget([
                        'dataProvider' => $dataProvider,
                        'filterModel' => $searchModel,
                        'columns' => [
                            ['class' => 'yii\grid\SerialColumn'],
//            'id',
                            'id_teknik',
                            'tahun',
                            'bulan',
                            'jumlah',
                            // 'created_at',
                            // 'updated_at',
                            ['class' => 'yii\grid\ActionColumn'],
                        ],
                    ]);
                    ?>
                    <?php Pjax::end(); ?></div>
            </div>
        </div>
    </div>
</div>

