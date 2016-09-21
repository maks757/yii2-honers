<?php
/**
 * @author Maxim Cherednyk <maks757q@gmail.com, +380639960375>
 */

namespace bl\progress\components;

use bl\imagable\BaseImagable;
use bl\progress\entities\UserProgress;
use bl\progress\interfaces\IProgressValidator;
use bl\progress\interfaces\IValidator;
use common\models\User;
use yii\base\Object;
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
                /**@var BaseImagable $imagine */
                $imagine = \Yii::$app->imagableProgress;
                $nameImage = $imagine->create('progress', BaseFileHelper::normalizePath($params['image']));

                $progress_key = get_class($validator);

                if(empty(UserProgress::findOne(['user_id' => $user->id, 'progress_key' => $progress_key]))) {
                    $progress = new UserProgress();
                    $progress->load($params, '');

                    $progress->user_id = $user->id;
                    $progress->image = $nameImage;
                    $progress->progress_key = $progress_key;

                    if ($progress->validate())
                        $progress->save();
                }
            }
        }
    }
}