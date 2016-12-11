<?php

namespace bl\progress\entities;

use Yii;

/**
 * This is the model class for table "user_progress_images".
 *
 * @property integer $id
 * @property string $image_key
 * @property string $image
 * @property string $name
 * @property string $progress_key
 * @property string $short_description
 * @property string $long_description
 * @property integer $group
 * @property integer $position
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
            [['progress_key'], 'string', 'max' => 128],
            [['name', 'short_description'], 'string', 'max' => 100],
            [['long_description'], 'string', 'max' => 255],
            [['group', 'position'], 'integer'],
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

    /**
     * @return \yii\db\ActiveQuery|UserProgressImages
     */
    public function getProgress()
    {
        return $this->hasOne(UserProgress::className(), ['image_id' => 'id']);
    }
}
