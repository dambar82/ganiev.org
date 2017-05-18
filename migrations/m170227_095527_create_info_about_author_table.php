<?php

use yii\db\Migration;

/**
 * Handles the creation of table `info_about_author`.
 */
class m170227_095527_create_info_about_author_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('info_about_author', [
            'id' => $this->primaryKey(),
            'content' => $this->text(),
            'author' => $this->text()
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('info_about_author');
    }
}
