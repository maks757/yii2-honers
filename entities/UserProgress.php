<?php

namespace bl\progress\entities;

use Yii;

/**
 * This is the model class for table "user_progress".
 *
 * @property integer $id
 * @property string $progress_key
 * @property integer $user_id
 * @property integer $image_id
 * @property string $name
 * @property string $short_description
 * @property string $long_description
 */
class UserProgress extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user_progress';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'image_id'], 'integer'],
            [['progress_key'], 'string', 'max' => 128],
            [['name', 'short_description'], 'string', 'max' => 100],
            [['long_description'], 'string', 'max' => 255],
            [['image_id'], 'exist', 'skipOnError' => true, 'targetClass' => UserProgressImages::className(), 'targetAttribute' => ['image_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'progress_key' => 'Progress Key',
            'user_id' => 'User ID',
            'name' => 'Name',
            'short_description' => 'Short Description',
            'long_description' => 'Long Description',
        ];
    }

    /**
     * @param integer $user_id
     * @return static[]|UserProgress[]
     */
    public static function getUserProgress($user_id = null){
        if(empty($user_id))
            $user_id = Yii::$app->user->id;
        $userProgress = UserProgress::findAll(['user_id' => $user_id]);
        return $userProgress;
    }

    /**
     * @return \yii\db\ActiveQuery|UserProgressImages
     */
    public function getImage()
    {
        return $this->hasOne(UserProgressImages::className(), ['id' => 'image_id']);
    }
}
