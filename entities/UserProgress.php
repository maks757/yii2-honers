<?php

namespace bl\progress\entities;

use Yii;

/**
 * This is the model class for table "user_progress".
 *
 * @property integer $id
 * @property string $progress_key
 * @property integer $user_id
 * @property string $name
 * @property string $image
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
            [['user_id'], 'integer'],
            [['name', 'short_description'], 'string', 'max' => 100],
            [['progress_key'], 'string', 'max' => 128],
            [['image'], 'string', 'max' => 60],
            [['long_description'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'name' => 'Name',
            'image' => 'Image',
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
}
