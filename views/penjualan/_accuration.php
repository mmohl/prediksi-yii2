<?php

use yii\bootstrap\Html;

$no = 1;
$this->registerCssFile('@web/css/penjualan/prediksi.custom.css');
?>
<?= Html::beginForm(['/penjualan/prediction'], 'POST') ?>
<div class="row">
    <div class="col-lg-4">
        <div class="form-group">
            <label for="">Teknik</label>
            <div class="input-group">
                <?= Html::activeDropDownList($model, 'teknik', $tekniks, ['class' => 'form-control']) ?>
                <div class="input-group-btn">
                    <button class="btn btn-default" type="submit" id="teknik-button">
                        <?= Yii::t('app', 'Pilih') ?>
                    </button>
                </div>
            </div>
            <?= Html::activeHiddenInput($model, 'tahun') ?>
        </div>
    </div>
</div>
<?= Html::endForm() ?>
<table id="table-prediction" class="table table-bordered">
    <thead>
        <tr>
            <th>No</th>
            <th>Bulan</th>
            <th>Penjualan</th>
            <th>Forecase</th>
            <th>Kesalahan</th>
            <th>Kesalahan (Kwadrat)</th>
            <th>Selisih (%)</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($datas['prediction'] as $month => $data): ?>
            <tr>
                <td><?= $no ?></td>
                <td style="text-transform: capitalize"><?= $month ?></td>
                <td><?= $data['penjualan'] ?></td>
                <td><?= $data['forecase'] ?></td>
                <td><?= $data['error'] ?></td>
                <td><?= $data['errorKw'] ?></td>
                <td><?= $data['selisih'] ?></td>
            </tr>
            <?php
            $no++;
        endforeach;
        ?>
    </tbody>
    <tfoot>
        <tr>
            <td colspan="4">
                <span style="text-transform: uppercase">
                    <center><strong>total</strong></center>
                </span>
            </td>
            <?php foreach ($datas['total'] as $total): ?>
                <td><?= $total ?></td>
            <?php endforeach; ?>
        </tr>
        <tr>
            <?php foreach ($datas['errorPrediction'] as $key => $data): ?>
                <td colspan="<?= $key === 'selisih' ? 2 : 0 ?>" class="column-label">
                    <?= $key ?> <?= $key === 'selisih' ? ' (%)' : '' ?>
                </td>
                <td><?= $data ?></td>
            <?php endforeach; ?>
        </tr>
    </tfoot>
</table>