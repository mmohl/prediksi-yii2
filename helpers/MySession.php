<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace app\helpers;

/**
 * Description of MySession
 *
 * @author mmohl
 */
class MySession {

    private static $PREDICTION_KEY = 'prediction_session';
    private static $ONE_PREDICTION = 'the_prediction_key';

    public static function saveToSession($key, $data) {
        $session = \Yii::$app->session;

        if (!$session->isActive) {
            $session->open();
        }

        $session->set($key, $data);

//        $session->close();
    }

    public static function getPredictionKey() {
        return self::$PREDICTION_KEY;
    }

    public static function getOnePredictionKey() {
        return self::$ONE_PREDICTION;
    }

}
