<?php

use yii\db\Migration;

class m170623_012916_create_table_teknik extends Migration {
    /*
      public function safeUp()
      {

      }

      public function safeDown()
      {
      echo "m170623_012916_create_table_teknik cannot be reverted.\n";

      return false;
      }
     */

    // Use up()/down() to run migration code without a transaction.
    public function up() {
        $this->createTable('teknik_penjualan', [
            'id' => $this->primaryKey()->unsigned(),
            'nama_teknik' => $this->string(100)->notNull(), // varchar(100) NOT NULL,
            'parent' => $this->integer(10)->unsigned()->notNull(), // int(10) unsigned NOT NULL,
            'kode' => $this->char(5)->notNull(), // char(5) NOT NULL
        ]);
    }

    public function down() {
        echo "m170623_012916_create_table_teknik cannot be reverted.\n";

        return false;
    }

}
