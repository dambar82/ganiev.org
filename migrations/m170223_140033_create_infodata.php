<?php

use yii\db\Migration;

class m170223_140033_create_infodata extends Migration
{
    public function up()
    {
        $this->batchInsert('info',['content'],[
            ['<p>о авторе</p>'],
            ['<p>о проекте</p>']
        ]);
    }

    public function down()
    {
        echo "m170223_140033_create_infodata cannot be reverted.\n";

        return false;
    }
}
