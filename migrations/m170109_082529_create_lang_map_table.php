<?php

use yii\db\Migration;

/**
 * Handles the creation of table `lang_map`.
 */
class m170109_082529_create_lang_map_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('lang_map', [
            'id' => $this->primaryKey(),
            'value' => $this->string()
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('lang_map');
    }
}
