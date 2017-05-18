<?php

use yii\db\Migration;

/**
 * Handles the creation of table `dict_audio`.
 */
class m170113_083418_create_dict_audio_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('dict_audio', [
            'id' => $this->primaryKey(),
            'fid' => $this->integer()->notNull()
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('dict_audio');
    }
}
