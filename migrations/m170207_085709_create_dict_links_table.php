<?php

use yii\db\Migration;

/**
 * Handles the creation of table `dict_links`.
 */
class m170207_085709_create_dict_links_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('dict_links', [
            'id' => $this->primaryKey(),
            'word_id' => $this->integer(),
            'value' => $this->string(),
            'link_word_id' => $this->integer()
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('dict_links');
    }
}
