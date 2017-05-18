<?php

use yii\db\Migration;

class m170123_080623_edit_word_table2 extends Migration
{
    public function up()
    {
        $this->addColumn('dict_word','status',$this->integer());
        $this->addColumn('dict_word','audio_status',$this->integer());
    }

    public function down()
    {
        echo "m170123_080623_edit_word_table2 cannot be reverted.\n";

        return false;
    }

}
