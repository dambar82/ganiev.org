<?php

namespace app\backend\models;

use Yii;

/**
 * This is the model class for table "info_about_author".
 *
 * @property integer $id
 * @property string $content
 * @property string $content_tat
 * @property string $author
 * @property string $author_tat
 */
class InfoAboutAuthor extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'info_about_author';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['content', 'author', 'content_tat', 'author_tat'], 'required'],
            [['content', 'content_tat', 'author_tat'], 'string'],
            [['author'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'content' => 'Русский текст',
            'content_tat' => 'Татарский текст',
            'author' => 'Автор по русски',
            'author_tat' => 'Автор по татарски',
        ];
    }
}
