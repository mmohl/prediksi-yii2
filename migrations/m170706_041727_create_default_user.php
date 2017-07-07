<?php

use yii\db\Migration;

class m170706_041727_create_default_user extends Migration {
    /*
      public function safeUp()
      {

      }

      public function safeDown()
      {
      echo "m170706_041727_create_default_user cannot be reverted.\n";

      return false;
      }

     */

    // Use up()/down() to run migration code without a transaction.
    public function up() {
        $this->insert('user', [
            'name' => 'admin',
            'username' => 'admin', // varchar(20) NOT NULL,
            'password' => '$2y$10$JjsLNjLC0ZLezF4gGdeWuenzG7rps/Z4iS2DwJrCc52jXWyMHAKtG', // varchar(255) NOT NULL,
            'isActive' => '1',
            'auth_key' => '=y?C??b????<???Q??D?t ?',
            'access_token' => '',
            'created_at' => '1498270041',
            'updated_at' => ''
        ]);
    }

    public function down() {
        echo "m170706_041727_create_default_user cannot be reverted.\n";

        return false;
    }

}
