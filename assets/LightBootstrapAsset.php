<?php

/*
 * The MIT License
 *
 * Copyright 2017 mmohl.
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 */

namespace app\assets;

use yii\web\AssetBundle;

class LightBootstrapAsset extends AssetBundle {

    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'templates/lightbootstrap/assets/css/animate.min.css',
        'templates/lightbootstrap/assets/css/bootstrap.min.css',
        'templates/lightbootstrap/assets/css/light-bootstrap-dashboard.css',
        'templates/lightbootstrap/assets/css/pe-icon-7-stroke.css'
    ];
    public $js = [
        'templates/lightbootstrap/assets/js/bootstrap-checkbox-radio-switch.js',
        'templates/lightbootstrap/assets/js/bootstrap-notify.js',
        'templates/lightbootstrap/assets/js/bootstrap-select.js',
        'templates/lightbootstrap/assets/js/bootstrap.min.js',
        'templates/lightbootstrap/assets/js/light-bootstrap-dashboard.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
//        'yii\web\JqueryAsset'
    ];

}
