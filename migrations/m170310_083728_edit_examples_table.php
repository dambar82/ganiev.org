<?php

use yii\db\Migration;

class m170310_083728_edit_examples_table extends Migration
{
    public function up()
    {
        $this->addColumn('dict_examples','type',$this->integer()->defaultValue(0));
    }

    public function down()
    {
        echo "m170310_083728_edit_examples_table cannot be reverted.\n";

        return false;
    }

}
