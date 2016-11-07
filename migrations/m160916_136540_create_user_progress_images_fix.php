<?php

use bl\progress\entities\UserProgress;
use bl\progress\entities\UserProgressImages;
use console\controllers\ProgressController;
use yii\db\Migration;

class m160916_136540_create_user_progress_images_fix extends Migration
{
    public function up()
    {
        $this->addColumn('user_progress_images', 'progress_key', $this->string(128));
        $this->addColumn('user_progress_images', 'name', $this->string(100));
        $this->addColumn('user_progress_images', 'short_description', $this->string(100));
        $this->addColumn('user_progress_images', 'long_description', $this->string(255));

        $progress = UserProgress::find()->all();
        /** @var $prog UserProgress */
        foreach ($progress as $prog){
            if(empty(UserProgressImages::find()->where(['name' => $prog->name])->one())){
                /** @var $image UserProgressImages */
                $image = $prog->image;
                $image->name = $prog->name;
                $image->progress_key = $prog->progress_key;
                $image->short_description = $prog->short_description;
                $image->long_description = $prog->long_description;
                $image->save();
            }
        }

        $this->dropColumn('user_progress_images', 'progress_key');
        $this->dropColumn('user_progress_images', 'name');
        $this->dropColumn('user_progress_images', 'short_description');
        $this->dropColumn('user_progress_images', 'long_description');
    }

    public function down()
    {
        echo "m160916_135560_create_user_progress_images cannot be reverted.\n";

        $this->dropTable('user_progress_images');

        return true;
    }
}
