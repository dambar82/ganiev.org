<?php

namespace app\backend\models;

use Yii;

/**
 * This is the model class for table "alphabet".
 *
 * @property int $id
 * @property string $uppercase
 * @property string $lowercase
 * @property string $letter_audio
 * @property string $word
 * @property string $word_audio
 * @property string $word_image
 */
class Alphabet extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'alphabet';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['uppercase', 'lowercase', 'letter_audio', 'word', 'word_audio', 'word_image'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'uppercase' => 'Uppercase',
            'lowercase' => 'Lowercase',
            'letter_audio' => 'Letter Audio',
            'word' => 'Word',
            'word_audio' => 'Word Audio',
            'word_image' => 'Word Image',
        ];
    }
}
