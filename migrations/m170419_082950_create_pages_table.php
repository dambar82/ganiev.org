<?php

use yii\db\Migration;

/**
 * Handles the creation of table `pages`.
 */
class m170419_082950_create_pages_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('pages', [
            'id' => $this->primaryKey(),
            'page' => $this->string(),
            'name' => $this->string()
        ]);

        $this->batchInsert('pages',['page','name'],[
            ['Главная', 'mainpage'],
            ['Страница слов', 'words'],
            ['Об авторе', 'author'],
            ['О проекте', 'project'],
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('pages');
    }
}
