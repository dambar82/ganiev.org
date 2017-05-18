<?php

use yii\db\Migration;

class m170116_124603_edit_word_table extends Migration
{
    public function up()
    {
        $this->addColumn('{{%dict_word}}','ending',$this->string(255));
    }

    public function down()
    {
        echo "m170116_124603_edit_word_table cannot be reverted.\n";

        return false;
    }
}
