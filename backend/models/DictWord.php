<?php

namespace app\backend\models;

use Yii;

/**
 * This is the model class for table "dict_word".
 *
 * @property integer $id
 * @property string $word
 * @property integer $accent
 * @property integer $date_update
 * @property string $italic
 * @property string $ending
 * @property string $slug
 */
class DictWord extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'dict_word';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['word'], 'required'],
            [['accent','status','edit_status','full_status','date_update'], 'integer'],
            [['word', 'italic', 'ending','description','slug'], 'string', 'max' => 255],
        ];
    }

    public function behaviors()
    {
        return [
            'timestamp' => [
                'class' => 'yii\behaviors\TimestampBehavior',
                'attributes' => [
                    \yii\db\ActiveRecord::EVENT_BEFORE_INSERT => ['date_update'],
                    \yii\db\ActiveRecord::EVENT_BEFORE_UPDATE => ['date_update'],
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'word' => 'Слово',
            'accent' => 'Ударение (номер символа)',
            'italic' => 'Курсив (сокращения)',
            'ending' => 'Окончание (для прилагательных)',
            'status' => 'Отредактировано',
            'audio_status' => 'Аудиофайлы',
            'edit_status' => 'Технич.редактирование',
            'full_status' => 'ПОЛНАЯ ГОТОВНОСТЬ',
            'description' => 'Объяснение',
        ];
    }

    public function getMeaning()
    {
        return $this->hasMany(DictMeaning::className(), ['word_id' => 'id']);
    }

    public function getLinks()
    {
        return $this->hasMany(DictLinks::className(), ['word_id' => 'id']);
    }
}
