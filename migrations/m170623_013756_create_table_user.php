<?php

use yii\db\Migration;

class m170623_013756_create_table_user extends Migration {
    /*
      public function safeUp()
      {

      }

      public function safeDown()
      {
      echo "m170623_013756_create_table_user cannot be reverted.\n";

      return false;
      }
     */

    // Use up()/down() to run migration code without a transaction.
    public function up() {
        $this->createTable('user', [
            'id' => $this->primaryKey()->unsigned(), //int(10) unsigned NOT NULL,
            'name' => $this->string(100)->notNull(), // varchar(100) NOT NULL,
            'img' => $this->string(50)->null(), // varchar(50) NOT NULL,
            'username' => $this->string(20)->notNull(), // varchar(20) NOT NULL,
            'password' => $this->string(255)->notNull(), // varchar(255) NOT NULL,
            'isActive' => $this->char(1)->defaultValue('1'),
            'auth_key' => $this->string(255)->null(),
            'access_token' => $this->string(255)->null(),
            'created_at' => $this->integer(11)->notNull(),
            'updated_at' => $this->integer(11)->null(),
        ]);
    }

    public function down() {
        echo "m170623_013756_create_table_user cannot be reverted.\n";

        return false;
    }

}
