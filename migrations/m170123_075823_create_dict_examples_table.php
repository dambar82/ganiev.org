<?php

use yii\db\Migration;

/**
 * Handles the creation of table `dict_examples`.
 */
class m170123_075823_create_dict_examples_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('dict_examples', [
            'id' => $this->primaryKey(),
            'word_id' => $this->integer(),
            'meaning_id' => $this->integer(),
            'value' => $this->string(255)
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('dict_examples');
    }
}
