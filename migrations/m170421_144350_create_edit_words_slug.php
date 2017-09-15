<?php

use yii\db\Migration;

class m170421_144350_create_edit_words_slug extends Migration
{
    public function safeUp()
    {
        $this->addColumn('dict_word','slug',$this->string());

        $words = \app\backend\models\DictWord::find()->all();

        foreach ($words as $word) {
            $this->update('dict_word',['slug' => \app\helpers\SlugHelper::latin($word->word)],['id' => $word->id]);
        }
    }

    public function safeDown()
    {
        echo "m170421_144350_create_edit_words_slug cannot be reverted.\n";

        return false;
    }
}
