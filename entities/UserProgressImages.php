<?php

namespace bl\progress\entities;

use Yii;

/**
 * This is the model class for table "user_progress_images".
 *
 * @property integer $id
 * @property string $image_key
 * @property string $image
 */
class UserProgressImages extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user_progress_images';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['image_key'], 'string', 'max' => 128],
            [['image'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'image_key' => 'Image Key',
            'image' => 'Image',
        ];
    }
}
