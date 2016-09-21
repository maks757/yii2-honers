<?php
/**
 * @author Maxim Cherednyk <maks757q@gmail.com, +380639960375>
 */

namespace bl\progress\components;

use bl\progress\interfaces\IValidator;
use yii\base\Behavior;
use yii\web\IdentityInterface;

class ValidateProgress extends Behavior implements IValidator
{
    /** @inheritdoc */
    function validateOne($user)
    {
        /**@var IdentityInterface $user*/
        return $user->status === 10;
    }

    /** @inheritdoc */
    function validate()
    {
        /**@var IdentityInterface $user*/
        $user = \Yii::$app->user->identity;
        return $this->validateOne($user);
    }
}