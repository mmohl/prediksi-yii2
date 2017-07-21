<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Breadcrumb
 *
 * @author mmohl
 */

namespace app\helpers;

use yii\helpers\Html;

class Breadcrumb {

    /**
     *
     * @param array $lists
     * @return string
     */
    public static function generate($lists) {
        $html = '';

        if (empty($lists)) {
            return "";
        }

        foreach ($lists as $list) {
            if (is_array($list)) {
                $html .= Html::a($list['label'], $list['url'], ['class' => 'navbar-brand']) . Html::tag('i', '', ['class' => 'fa fa-angle-right navbar-brand']);
            } else {
                $html .= Html::tag('span', $list, ['class' => 'navbar-brand']);
            }
        }

        return $html;
    }

}
