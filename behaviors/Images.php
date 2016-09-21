<?php
/**
 * @author Maxim Cherednyk <maks757q@gmail.com, +380639960375>
 */

namespace bl\progress\behaviors;


use bl\imagable\BaseImagable;
use Yii;
use yii\base\Behavior;
use yii\helpers\BaseFileHelper;

class Images extends Behavior
{
    public function getImage($image_name, $category, $type)
    {
        /**@var BaseImagable $imagine */
        $imagine = \Yii::$app->imagableProgress;
        $imagePath = $imagine->get($category, $type, $image_name);
        $aliasPath = BaseFileHelper::normalizePath(Yii::getAlias('@webroot'));
        $image = str_replace($aliasPath,'',$imagePath);

        return $image;
    }
}