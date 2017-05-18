<?php

namespace app\backend\models;

use Yii;

/**
 * This is the model class for table "dict_meaning".
 *
 * @property integer $id
 * @property integer $word_id
 * @property string $description
 * @property string $audio_id
 */
class DictMeaning extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'dict_meaning';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['word_id'], 'required'],
            [['word_id'], 'integer'],
            [['description','italic','russian_description'], 'string'],
            [['audio_id'], 'string', 'max' => 255],
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
            'description' => 'Перевод (на татарском)',
            'audio_id' => 'Аудиофайл',
            'italic' => 'Курсив (сокращения)',
            'russian_description' => 'Описание (на русском)',
        ];
    }

    public function getExamples()
    {
        return $this->hasMany(DictExamples::className(), ['meaning_id' => 'id']);
    }
}
