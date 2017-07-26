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

use yii\helpers\Html;
use yii\helpers\Url;
?>
<head>

    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

    <title><?= Html::encode($this->title) ?></title>

    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>

    <link rel="apple-touch-icon-precomposed" sizes="57x57" href="<?= Url::to('@web/favicons/') ?>apple-touch-icon-57x57.png" />
    <link rel="apple-touch-icon-precomposed" sizes="144x144"    href="<?= Url::to('@web/favicons/') ?>apple-touch-icon-144x144.png" />
    <link rel="apple-touch-icon-precomposed" sizes="72x72"      href="<?= Url::to('@web/favicons/') ?>apple-touch-icon-72x72.png" />
    <link rel="apple-touch-icon-precomposed" sizes="60x60"      href="<?= Url::to('@web/favicons/') ?>apple-touch-icon-60x60.png" />
    <link rel="apple-touch-icon-precomposed" sizes="114x114"    href="<?= Url::to('@web/favicons/') ?>apple-touch-icon-114x114.png" />
    <link rel="apple-touch-icon-precomposed" sizes="120x120"    href="<?= Url::to('@web/favicons/') ?>apple-touch-icon-120x120.png" />
    <link rel="apple-touch-icon-precomposed" sizes="76x76"      href="<?= Url::to('@web/favicons/') ?>apple-touch-icon-76x76.png" />
    <link rel="apple-touch-icon-precomposed" sizes="152x152"    href="<?= Url::to('@web/favicons/') ?>apple-touch-icon-152x152.png" />
    <link rel="icon" type="image/png" href="<?= Url::to('@web/favicons/') ?>favicon-196x196.png" sizes="196x196" />
    <link rel="icon" type="image/png" href="<?= Url::to('@web/favicons/') ?>favicon-96x96.png" sizes="96x96" />
    <link rel="icon" type="image/png" href="<?= Url::to('@web/favicons/') ?>favicon-32x32.png" sizes="32x32" />
    <link rel="icon" type="image/png" href="<?= Url::to('@web/favicons/') ?>favicon-16x16.png" sizes="16x16" />
    <link rel="icon" type="image/png" href="<?= Url::to('@web/favicons/') ?>favicon-128.png" sizes="128x128" />
    <meta name="application-name" content="&nbsp;"/>
    <meta name="msapplication-TileColor" content="#FFFFFF" />
    <meta name="msapplication-TileImage" content="<?= Url::to('@web/favicons/') ?>mstile-144x144.png" />
    <meta name="msapplication-square70x70logo" content="<?= Url::to('@web/favicons/') ?>mstile-70x70.png" />
    <meta name="msapplication-square150x150logo" content="<?= Url::to('@web/favicons/') ?>mstile-150x150.png" />
    <meta name="msapplication-wide310x150logo" content="<?= Url::to('@web/favicons/') ?>mstile-310x150.png" />
    <meta name="msapplication-square310x310logo" content="<?= Url::to('@web/favicons/') ?>mstile-310x310.png" />


    <!--         Fonts and icons
        <link href="http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
        <link href='http://fonts.googleapis.com/css?family=Roboto:400,700,300' rel='stylesheet' type='text/css'>
        <link href="assets/css/pe-icon-7-stroke.css" rel="stylesheet" />-->

    <?php $this->head() ?>
</head>
