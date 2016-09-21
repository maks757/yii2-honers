<?php

use yii\db\Migration;

class m160916_135540_create_user_progress_images extends Migration
{
    public function up()
    {
        $this->createTable('user_progress_images', [
            'id' => $this->primaryKey(),
            'image_key' => $this->string(128),
            'image' => $this->string(),
        ]);


    }

    public function down()
    {
        echo "m160916_135560_create_user_progress_images cannot be reverted.\n";

        $this->dropTable('user_progress_images');

        return true;
    }
}
