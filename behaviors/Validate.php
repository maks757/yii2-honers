<?php
/**
 * @author Maxim Cherednyk <maks757q@gmail.com, +380639960375>
 */

namespace bl\progress\behaviors;


use bl\progress\interfaces\IProgressValidator;
use bl\progress\interfaces\IValidator;
use yii\base\Behavior;
use yii\base\Exception;

class Validate extends Behavior
{
    /**
     * @var IProgressValidator
     */
    private $validatorClass = null;

    public function __construct(IProgressValidator $validatorClass, $config = array())
    {
        parent::__construct($config);
        $this->validatorClass = $validatorClass;
    }

    /**
     * @param string $key
     * @param integer $user_id
     * @return mixed
     * @throws Exception
     */
    public function validateOne($key, $user_id)
    {
        $validator = $this->classFilter($key);
        return $this->validatorClass->validateProgressOne($validator, $user_id, $this->owner->honors[$key]);
    }

    /**
     * @param string $key
     * @return mixed
     */
    public function validate($key)
    {
        $validator = $this->classFilter($key);
        return $this->validatorClass->validateProgress($validator, $this->owner->honors[$key]);
    }

    /**
     * @param string $key
     * @return object
     * @throws Exception
     */
    private function classFilter($key)
    {
        $config = $this->owner->honors[$key];
        if(class_exists($config['class'])) {
            $validator = \Yii::createObject($config['class']);
            if($validator instanceof IValidator) {
//                unset($this->owner->honors[$key]['class']);
                $this->owner->honors[$key]['image'] = \Yii::getAlias($this->owner->honors[$key]['image']);
                return $validator;
            }
            else
                throw new Exception('Class '.$config['class'].' not implements '.IValidator::class);
        }
        else
            throw new Exception('Class '.$config['class'].' not found.');
    }
}