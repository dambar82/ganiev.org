<?php

use yii\db\Migration;

/**
 * Handles the creation of table `seo_eav`.
 */
class m170419_082959_create_seo_eav_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('seo_eav', [
            'id' => $this->primaryKey(),
            'title' => $this->string(),
            'description' => $this->text(),
            'keywords' => $this->string(),
            'lang_id' => $this->integer(),
	'page_id' => $this->integer()
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('seo_eav');
    }
}
