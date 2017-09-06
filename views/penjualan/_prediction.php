<table class="table table-bordered">
    <thead>
        <tr>
            <th>Bulan</th>
            <?php foreach ($predictions['januari'] as $key => $value): ?>
                <th><?= $key ?></th>
            <?php endforeach; ?>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($predictions as $month => $prediction): ?>
            <tr>
                <td><?= ucfirst($month) ?></td>
                <?php foreach ($prediction as $value): ?>
                    <td><?= $value ?></td>
                <?php endforeach; ?>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>