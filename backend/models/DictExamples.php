<?php

namespace app\backend\models;

use Yii;

/**
 * This is the model class for table "dict_examples".
 *
 * @property integer $id
 * @property integer $word_id
 * @property integer $meaning_id
 * @property string $rus_value
 * @property string $tat_value
 */
class DictExamples extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'dict_examples';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['word_id'], 'required'],
            [['word_id', 'meaning_id','type'], 'integer'],
            [['rus_value', 'tat_value'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'word_id' => 'Слово',
            'meaning_id' => 'Значение слова',
            'rus_value' => 'На русском',
            'tat_value' => 'На татарском',
            'Тип' => 'Выберите тип',
        ];
    }
}
