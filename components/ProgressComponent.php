<?php
/**
 * @author Maxim Cherednyk <maks757q@gmail.com, +380639960375>
 */

namespace bl\progress\components;

use bl\imagable\BaseImagable;
use bl\progress\entities\UserProgress;
use bl\progress\entities\UserProgressImages;
use bl\progress\interfaces\IProgressValidator;
use bl\progress\interfaces\IValidator;
use common\models\User;
use yii\base\Object;
use yii\base\Security;
use yii\helpers\BaseFileHelper;

class ProgressComponent extends Object implements IProgressValidator
{
    /** @inheritdoc */
    function validateProgressOne($validator, $user_id, $params)
    {
        $this->validate($validator, $user_id, $params);
    }

    /** @inheritdoc */
    function validateProgress($validator, $params)
    {
        $this->validate($validator, \Yii::$app->user->id, $params);
    }

    private function validate($validator, $user_id, $params){
        $user = User::findOne($user_id);
        if(!empty($user)){
            /** @var IValidator $validator */
            if($validator->validateOne($user)){
                $progress_key = get_class($validator);

                if(empty(UserProgress::findOne(['user_id' => $user->id, 'progress_key' => $progress_key]))) {
                    $progress = new UserProgress();
                    $progress->load($params, '');

                    $progress->user_id = $user->id;
                    $progress->progress_key = $progress_key;

                    $image_key = hash_hmac('md5', $params['image'], 'progress_hash_key');

                    /** @var BaseImagable $imagable*/
                    $imagable = \Yii::$app->imagableProgress;
                    $image_name = $imagable->create('progress', BaseFileHelper::normalizePath($params['image']));

                    if(empty($user_image = UserProgressImages::findOne(['image_key' => $image_key]))) {
                        $user_image = new UserProgressImages();
                        $user_image->image = $image_name;
                        $user_image->image_key = $image_key;
                        if($user_image->validate())
                            $user_image->save();
                        else
                            $user_image = null;
                    }
                    if ($progress->validate()) {
                        $progress->image_id = $user_image->id;
                        $progress->save();
                    }
                }
            }
        }
    }
}