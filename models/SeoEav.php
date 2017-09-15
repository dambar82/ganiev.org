<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "seo_eav".
 *
 * @property integer $id
 * @property string $title
 * @property string $description
 * @property string $keywords
 * @property integer $lang_id
 * @property integer $page_id
 */
class SeoEav extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'seo_eav';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['description'], 'string'],
            [['lang_id','page_id'], 'integer'],
            [['title', 'keywords'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'description' => 'Description',
            'keywords' => 'Keywords',
            'lang_id' => 'Lang',
            'page_id' => 'Page',
        ];
    }
}
