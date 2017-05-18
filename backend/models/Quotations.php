<?php

namespace app\backend\models;

use Yii;

/**
 * This is the model class for table "quotations".
 *
 * @property integer $id
 * @property string $content
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
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'content' => 'Цитата',
        ];
    }
}
