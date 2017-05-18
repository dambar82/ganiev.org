<?php

use yii\db\Migration;

/**
 * Handles the creation of table `quotations`.
 */
class m170227_065104_create_quotations_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('quotations', [
            'id' => $this->primaryKey(),
            'content' => $this->text()
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('quotations');
    }
}
