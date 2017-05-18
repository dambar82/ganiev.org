<?php

namespace app\backend\models;

use Yii;

/**
 * This is the model class for table "dict_links".
 *
 * @property integer $id
 * @property integer $word_id
 * @property string $value
 * @property integer $link_word_id
 */
class DictLinks extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'dict_links';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['word_id', 'link_word_id'], 'integer'],
            [['value'], 'string', 'max' => 255],
            [['link_word_id'], 'required'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'word_id' => 'Word ID',
            'value' => 'Value',
            'link_word_id' => 'Слово на которое ссылаемся',
        ];
    }
}
