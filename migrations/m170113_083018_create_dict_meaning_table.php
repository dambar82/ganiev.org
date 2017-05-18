<?php

use yii\db\Migration;

/**
 * Handles the creation of table `dict_meaning`.
 */
class m170113_083018_create_dict_meaning_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('dict_meaning', [
            'id' => $this->primaryKey(),
            'word_id' => $this->integer()->notNull(),
            'description' => $this->text()->notNull(),
            'audio_id' => $this->integer()->notNull()
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('dict_meaning');
    }
}
