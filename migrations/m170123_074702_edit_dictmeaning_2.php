<?php

use yii\db\Migration;

class m170123_074702_edit_dictmeaning_2 extends Migration
{
    public function safeUp()
    {
        $this->addColumn('dict_meaning','russian_description',$this->string(255)->after('word_id'));
        $this->addColumn('dict_meaning','italic',$this->string(255)->after('word_id'));
    }

    public function safeDown()
    {
        echo "m170123_074702_edit_dictmeaning_2 cannot be reverted.\n";

        return false;
    }
}
