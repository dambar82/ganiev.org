<?php

namespace app\backend\models;

/**
 * This is the model class for table "photos".
 *
 * @property int $id
 * @property string $photo
 */
class Photo extends \yii\db\ActiveRecord
{
    public $image;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'photos';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['photo'], 'string', 'max' => 255],
           // [['photo'], 'file', 'extensions' => 'png, jpg, jpeg'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'photo' => 'Photo',
        ];
    }

    public function upload()
    {
        if ($this->validate()) {
            $filePath = 'source/photos/' . uniqid() . '.' . $this->photo->extension;
            $this->photo->saveAs($filePath);
            return $filePath;
        } else {
            return false;
        }
    }
}
