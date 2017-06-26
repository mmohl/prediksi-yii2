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

<div class="sidebar-wrapper">
    <div class="logo">
        <a href="http://www.creative-tim.com" class="simple-text">
            Creative Tim
        </a>
    </div>

    <ul class="nav">
        <li>
            <a href="<?= Url::to(['/']) ?>">
                <i class="pe-7s-graph"></i>
                <p>Dashboard</p>
            </a>
        </li>
        <li>
            <a href="<?= Url::to(['/teknik/index']) ?>">
                <i class="pe-7s-user"></i>
                <p>Teknik Penjualan</p>
            </a>
        </li>
        <li>
            <a href="table.html">
                <i class="pe-7s-note2"></i>
                <p>Import Data</p>
            </a>
        </li>
        <li>
            <a href="typography.html">
                <i class="pe-7s-news-paper"></i>
                <p>Data Penjualan</p>
            </a>
        </li>
        <li>
            <a href="icons.html">
                <i class="pe-7s-science"></i>
                <p>Prediksi Penjualan</p>
            </a>
        </li>
        <li>
            <a href="maps.html">
                <i class="pe-7s-map-marker"></i>
                <p>Grafik</p>
            </a>
        </li>
    </ul>
</div>
