<?php

use yii\db\Migration;

class m170310_074137_edit_words_table extends Migration
{
    public function up()
    {
        $this->addColumn('dict_word','edit_status',$this->integer()->defaultValue(0));
        $this->addColumn('dict_word','full_status',$this->integer()->defaultValue(0));
    }

    public function down()
    {
        echo "m170310_074137_edit_words_table cannot be reverted.\n";

        return false;
    }
}
