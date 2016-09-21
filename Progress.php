<?php
/**
 * @author Maxim Cherednyk <maks757q@gmail.com, +380639960375>
 */

namespace bl\progress;


use bl\progress\behaviors\Images;
use bl\progress\behaviors\Validate;
use yii\base\Component;

/**
 * @method validateOne(string $key, int $user_id)
 * @method validate(string $key)
 * @method getImage(string $image_name, string $category, string $type)
*/

class Progress extends Component
{
    public $honors = [];
    public $validatorClass;

    public function behaviors()
    {
        return [
            'validate' => [
                'class' => Validate::class
            ],
            'images' => [
                'class' => Images::class
            ]
        ];
    }


    public function init()
    {
        parent::init();
        $this->registerDependencies();
    }

    private function registerDependencies()
    {
        \Yii::$container->set('bl\progress\interfaces\IProgressValidator',
            $this->validatorClass);
    }
}