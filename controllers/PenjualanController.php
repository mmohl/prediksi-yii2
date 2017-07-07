<?php

namespace app\controllers;

use app\models\searches\PenjualanSearch;

class PenjualanController extends \yii\web\Controller {

    public function actionImport() {
        $model = new \app\models\Data;

        if (\Yii::$app->request->post()) {
            $model->import('');

            return $this->render('import');
        }

        return $this->render('import', ['model' => $model]);
    }

    public function actionIndex() {
        $searchModel = new PenjualanSearch();
        $dataProvider = $searchModel->search(\Yii::$app->request->queryParams);

        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    public function actionPrediction() {
        return $this->render('prediction');
    }

    public function actionChart() {
        return $this->render('chart');
    }

}
