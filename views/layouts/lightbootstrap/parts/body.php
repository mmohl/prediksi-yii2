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

use yii\helpers\Url;
?>
<body>
    <?php $this->beginBody() ?>
    <div class="wrapper">
        <div class="sidebar" data-color="red" data-image="<?= Url::to('@web/templates/lightbootstrap/assets/img/sidebar-4.jpg', true) ?>">
            <!-- side menu -->
            <?php include_once 'menu.php'; ?>
        </div>
        <div class="main-panel">
            <!-- Main Panel -->
            <?php include_once 'panel.php' ?>
            <!-- Content -->
            <div class="content">
                <div class="container-fluid">
                    <?= $content ?>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <?php include_once 'footer.php' ?>

    <?php $this->endBody() ?>
</body>