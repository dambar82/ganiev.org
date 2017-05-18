<?php

use yii\db\Migration;

/**
 * Handles the creation of table `dict_word`.
 */
class m170113_075755_create_dict_word_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('dict_word', [
            'id' => $this->primaryKey(),
            'word' => $this->string()->notNull(),
            'accent' => $this->integer()->defaultValue(0),
            'italic' => $this->string()
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('dict_word');
    }
}
