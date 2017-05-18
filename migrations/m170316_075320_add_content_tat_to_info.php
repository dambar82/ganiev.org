<?php

use yii\db\Migration;

class m170316_075320_add_content_tat_to_info extends Migration
{
    public function up()
    {
        $this->addColumn('info', 'content_tat', $this->text());
        $this->addColumn('info_about_author', 'content_tat', $this->text());
        $this->addColumn('info_about_author', 'author_tat', $this->text());
    }

    public function down()
    {
        echo "m170316_075320_add_content_tat_to_info cannot be reverted.\n";

        return false;
    }

}
