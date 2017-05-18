<?php

use yii\db\Migration;

/**
 * Handles the creation of table `dict_abbr`.
 */
class m170506_105629_create_dict_abbr_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('dict_abbr', [
            'id' => $this->primaryKey(),
            'abbr' => $this->string(),
            'title' => $this->string()
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('dict_abbr');
    }
}
