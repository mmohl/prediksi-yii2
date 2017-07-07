<?php

use yii\helpers\Html;
?>

<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="content">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for=""><?= ucfirst(Yii::t('app', 'jumlah data')) ?></label>
                            <input type="text" class="form-control" value="2" readonly="true">
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for=""><?= ucfirst(Yii::t('app', 'nilai tahun')) ?></label>
                            <input type="text" class="form-control" value="50" readonly="true">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- List Data -->
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="header">
                <div class="title">
                    <h3><?= Yii::t('app', 'Data Penjualan') ?></h3>
                </div>
                <span class="category"><?= ucwords(Yii::t('app', 'List Penjualan')) ?></span>
            </div>
            <div class="content">
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th><?= ucfirst(Yii::t('app', 'tahun')) ?></th>
                                <th><?= ucfirst(Yii::t('app', 'bulan')) ?></th>
                                <th><?= ucfirst(Yii::t('app', 'A')) ?></th>
                                <th><?= ucfirst(Yii::t('app', 'B')) ?></th>
                                <th><?= ucfirst(Yii::t('app', 'C')) ?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1990</td>
                                <td>1</td>
                                <td>10</td>
                                <td>10</td>
                                <td>20</td>
                            </tr>
                            <tr>
                                <td>1990</td>
                                <td>1</td>
                                <td>10</td>
                                <td>10</td>
                                <td>20</td>
                            </tr>
                        </tbody>
                        <tfoot>
                            <tr class="label-info">
                                <td colspan="2" style="text-align: center"><?= ucfirst(Yii::t('app', 'jumlah')) ?></td>
                                <td>20</td>
                                <td>20</td>
                                <td>40</td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<!--end list data-->


<!--hasil prediksi-->
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="header">
                <div class="title">
                    <h3>Hasil</h3>
                </div>
            </div>
            <div class="content">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th><?= ucfirst(Yii::t('app', 'tahun')) ?></th>
                            <th><?= ucfirst(Yii::t('app', 'bulan')) ?></th>
                            <th><?= ucfirst(Yii::t('app', 'A')) ?></th>
                            <th><?= ucfirst(Yii::t('app', 'B')) ?></th>
                            <th><?= ucfirst(Yii::t('app', 'C')) ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1990</td>
                            <td>1</td>
                            <td>10</td>
                            <td>10</td>
                            <td>20</td>
                        </tr>
                    </tbody>
                    <tfoot>
                        <tr class="label-info">
                            <td colspan="5">Keterangan</td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>
<!--end hasil prediksi-->
