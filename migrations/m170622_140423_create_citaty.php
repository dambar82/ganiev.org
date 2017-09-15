<?php

use yii\db\Migration;

class m170622_140423_create_citaty extends Migration
{
    public function safeUp()
    {
        $this->addColumn('quotations', 'lang_id', $this->integer());
        $this->update('quotations', ['lang_id' => 2]);
    }

    public function safeDown()
    {
        echo "m170622_140423_create_citaty cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m170622_140423_create_citaty cannot be reverted.\n";

        return false;
    }
    */
}
