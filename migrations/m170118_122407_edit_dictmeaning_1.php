<?php

use yii\db\Migration;

class m170118_122407_edit_dictmeaning_1 extends Migration
{
    public function up()
    {
        $this->alterColumn('dict_meaning','audio_id',$this->string(255));
    }

    public function down()
    {
        echo "m170118_122407_edit_dictmeaning_1 cannot be reverted.\n";

        return false;
    }

}
