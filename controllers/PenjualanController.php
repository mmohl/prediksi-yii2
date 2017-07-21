<?php

namespace app\controllers;

use app\models\searches\PenjualanSearch;
use app\models\Data;
use app\models\Prediksi;
use yii\web\UploadedFile;

class PenjualanController extends \yii\web\Controller {

    public function actionImport() {
        $model = new Data;
        $flash = NULL;

        if (\Yii::$app->request->isPost) {

            $model->excel = UploadedFile::getInstance($model, 'excel');

            if ($model->upload()) {

                if ($model->import()) {
                    $flash = $model->getFlash(true);
                } else {
                    $flash = $model->getFlash(false);
                }

                return $this->render('import', ['model' => (new Data), 'flash' => $flash]);
            }
        }

        return $this->render('import', ['model' => $model, 'flash' => $flash]);
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
        $model = new Prediksi;

        if ($model->load(\Yii::$app->request->post()) && $model->validate()) {

            $model->calculate();

            return $this->render('prediction', [
                        'model' => $model
            ]);
        }

        return $this->render('prediction', ['model' => $model]);
    }

    public function actionChart() {
        $chart = new \app\models\Chart;

        if (!empty(\Yii::$app->request->get('Chart'))) {
            $chart->tekniks = [];
            $chart->load(\Yii::$app->request->get());
        }

        return $this->render('chart', ['chart' => $chart]);
    }

}
