<?php

use yii\db\Migration;

/**
 * Handles the creation of table `seo`.
 */
class m170419_082653_create_seo_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('seo', [
            'id' => $this->primaryKey(),
            'page' => $this->integer()
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('seo');
    }
}
