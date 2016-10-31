# Yii2 progress user

#### Install
```
php composer.phar require maks757/yii2-progress
```
or
```
composer require maks757/yii2-progress
```
and applying migrations
```
php yii migrate --migrationPath=@vendor/maks757/yii2-progress/migrations
```
or
```
yii migrate --migrationPath=@vendor/maks757/yii2-progress/migrations
```

#### Configuration

##### main.php (config)
```php
'components' => [
    // Progress config
    'progress' => [
        'class' => \bl\progress\Progress::className(),
        'validatorClass' => \bl\progress\components\ProgressComponent::className(),
        'honors' => [
            // name category
            'userConfirm' => [
                'class' => \bl\progress\components\ValidateProgress::className(), //class validator
                'name' => 'Registration success', // name user progress
                'image' => Yii::getAlias('@vendor/maks757/yii2-progress/image/user.png'), //path to image
                'long_description' => '', // 255 chars
                'short_description' => '', // 100 chars
            ]
        ]
    ],
    // Images config
    'imagableProgress' => [
        'class' => 'bl\imagable\Imagable',
        'imageClass' => \bl\progress\components\image\CreateImageImagine::className(),
        'nameClass' => \bl\progress\components\image\GenerateName::className(),
        'imagesPath' => '@webroot/progressImage',
        'categories' => [
            'category' => [
                'progress' => [
                    'origin' => false,
                    'size' => [
                        'long' => [
                            'width' => 500,
                            'height' => 500,
                        ],
                        'short' => [
                            'width' => 200,
                            'height' => 200,
                        ],
                    ]
                ],
            ]
        ]
    ],
    // ...
]
```
#### Using
Add 
```php
    /**
    *@var Progress $progress
    */
    $progress = Yii::$app->progress;
```
and
```php 
    // First variant
    // 1 param ( progress category )
    // 2 param ( user id )
    $progress->validateOne('userConfirm', 1);
```
or  
```php
    // Second variant
    // 1 param ( progress category )
    // its use current user id
    $progress->validate('userConfirm');
```
#### Using example
```php
$userProgress = \bl\progress\entities\UserProgress::getUserProgress($userRegisterInfo->id);
foreach ($userProgress as $value)
{
    /** *@var Progress $progress */
    $progress = Yii::$app->progress;
    $pathImage = $progress->getImage($value->image->image, 'progress', 'short');

    $content = Html::tag('h3', $value->name);
    $content .= Html::img($pathImage);
    echo Html::tag('div', $content, ['class' => 'col-sm-2']);
}
```
![Alt text](/image/author.jpg "Optional title")
