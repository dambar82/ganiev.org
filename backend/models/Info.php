<?php

namespace app\backend\models;

use Yii;

/**
 * This is the model class for table "info".
 *
 * @property integer $id
 * @property string $image_id
 * @property string $content
 * @property string $content_tat
 */
class Info extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'info';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['content', 'content_tat'], 'string'],
            [['image_id'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'image_id' => 'Фото',
            'content' => 'Русский текст',
            'content_tat' => 'Татарский текст',
        ];
    }
}
