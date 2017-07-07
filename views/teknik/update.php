<?php
/* @var $this yii\web\View */
/* @var $model app\models\Teknik */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
            'modelClass' => 'Teknik',
        ]) . $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Tekniks'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="teknik-update">

    <?=
    $this->render('_form', [
        'model' => $model,
    ])
    ?>

</div>
