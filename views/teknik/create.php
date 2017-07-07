<?php
/* @var $this yii\web\View */
/* @var $model app\models\Teknik */

$this->title = Yii::t('app', 'Create Teknik');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Tekniks'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="teknik-create">

    <?=
    $this->render('_form', [
        'model' => $model,
    ])
    ?>

</div>
