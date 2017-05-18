<?php

use yii\db\Migration;

class m170123_121754_edit_dict_example1 extends Migration
{
    public function up()
    {
        $this->renameColumn('dict_examples','value','rus_value');
        $this->addColumn('dict_examples','tat_value',$this->string(255));
    }

    public function down()
    {
        echo "m170123_121754_edit_dict_example1 cannot be reverted.\n";

        return false;
    }

}
