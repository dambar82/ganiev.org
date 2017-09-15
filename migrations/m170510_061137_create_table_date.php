<?php

use yii\db\Migration;

class m170510_061137_create_table_date extends Migration
{
    public function safeUp()
    {
        $this->createTable('dict_date', [
            'id' => $this->primaryKey(),
            'date' => $this->integer()
        ]);

        $this->batchInsert('dict_date', ['date'],[
            ['1494067318'],
            ]);
    }

    public function safeDown()
    {
        echo "m170510_061137_create_table_date cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m170510_061137_create_table_date cannot be reverted.\n";

        return false;
    }
    */
}
