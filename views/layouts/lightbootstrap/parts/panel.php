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
use app\helpers\Breadcrumb;
?>

<nav class="navbar navbar-default navbar-fixed">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navigation-example-2">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>

            <?= Breadcrumb::generate($this->params['breadcrumbs']) ?>

        </div>
        <div class="collapse navbar-collapse">
            <ul class="nav navbar-nav navbar-left">
                <li>
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <i class="fa fa-dashboard"></i>
                        <p class="hidden-lg hidden-md">Dashboard</p>
                    </a>
                </li>
                <li>
                    <a href="">
                        <i class="fa fa-search"></i>
                        <p class="hidden-lg hidden-md">Search</p>
                    </a>
                </li>
            </ul>

            <ul class="nav navbar-nav navbar-right">
                <li>
                    <a class="btn" href="<?= Url::to(['user/view', 'id' => Yii::$app->user->getId()]) ?>">
                        <?= Yii::t('app', 'Account') ?>
                    </a>
                </li>
                <li>
                    <?php
                    echo Html::beginForm(['/site/logout'], 'post');
                    echo Html::submitButton(
                            'Logout (' . Yii::$app->user->identity->username . ')', ['class' => 'btn']
                    );
                    echo Html::endForm();
                    ?>
                </li>

                <li class="separator hidden-lg hidden-md"></li>
            </ul>
        </div>
    </div>
</nav>