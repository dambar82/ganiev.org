<?php

use yii\db\Migration;

class m170123_140859_edit_word_table3 extends Migration
{
    public function up()
    {
        $this->addColumn('dict_word','description',$this->string(255)->after('word'));
    }

    public function down()
    {
        echo "m170123_140859_edit_word_table3 cannot be reverted.\n";

        return false;
    }
}
