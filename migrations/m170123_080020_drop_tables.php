<?php

use yii\db\Migration;

class m170123_080020_drop_tables extends Migration
{
    public function up()
    {
        $this->dropTable('test');
    }

    public function down()
    {
        echo "m170123_080020_drop_tables cannot be reverted.\n";

        return false;
    }

    /*
    // Use safeUp/safeDown to run migration code within a transaction
    public function safeUp()
    {
    }

    public function safeDown()
    {
    }
    */
}
