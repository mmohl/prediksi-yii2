<?php

use yii\db\Migration;

/**
 * Handles the creation of table `penjualan`.
 */
class m170623_010335_create_penjualan_table extends Migration {

    /**
     * @inheritdoc
     */
    public function up() {
        $this->createTable('penjualan', [
            'id' => $this->primaryKey(),
            'id_teknik' => $this->integer(11),
            'tahun' => $this->char(10)->notNull(), // char(10) NOT NULL,
            'bulan' => $this->char(50)->notNull(), // char(50) NOT NULL,
            'jumlah' => $this->integer(4)->null() // int(4) NOT NULL
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down() {
        $this->dropTable('penjualan');
    }

}
