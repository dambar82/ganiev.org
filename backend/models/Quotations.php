<?php

namespace app\backend\models;

use Yii;

/**
 * This is the model class for table "quotations".
 *
 * @property int $id
 * @property string $content
 * @property int $lang_id
 */
class Quotations extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'quotations';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['content'], 'string'],
            [['lang_id'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'content' => 'Content',
            'lang_id' => 'Lang ID',
        ];
    }
}
