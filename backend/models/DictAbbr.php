<?php

namespace app\backend\models;

use Yii;

/**
 * This is the model class for table "dict_abbr".
 *
 * @property int $id
 * @property string $abbr
 * @property string $title
 */
class DictAbbr extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'dict_abbr';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['abbr', 'title'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'abbr' => 'Условное сокращение',
            'title' => 'Расшифровка',
        ];
    }
}
