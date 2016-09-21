<?php
/**
 * @author Maxim Cherednyk <maks757q@gmail.com, +380639960375>
 */

namespace bl\progress\interfaces;


interface IProgressValidator
{
    /**
     * @param string $validator
     * @param integer $user_id
     * @param array $params
     */
    function validateProgressOne($validator, $user_id, $params);

    /**
     * @param string $validator
     * @param array $params
     */
    function validateProgress($validator, $params);
}