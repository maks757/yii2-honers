<?php
/**
 * @author Maxim Cherednyk <maks757q@gmail.com, +380639960375>
 */

namespace bl\progress\interfaces;


use yii\web\IdentityInterface;

interface IValidator
{
    /**
     * @param IdentityInterface $user
     * @return boolean
     */
    function validateOne($user);

    /**
     * @return boolean
     */
    function validate();
}