<?php

use yii\db\Migration;

class m170506_083940_add_column extends Migration
{
    public function safeUp()
    {
        $this->addColumn('dict_word','date_update',$this->integer());
        $this->update('dict_word',['date_update' => time()]);
    }

    public function safeDown()
    {
        echo "m170506_083940_add_column cannot be reverted.\n";

        return false;
    }
}
