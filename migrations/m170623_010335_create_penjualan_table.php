<?php

use yii\db\Migration;

/**
 * Handles the creation of table `penjualan`.
 */
class m170623_010335_create_penjualan_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('penjualan', [
            'id' => $this->primaryKey(),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('penjualan');
    }
}
