<?php

use yii\db\Migration;

class m160916_135550_create_user_progress extends Migration
{
    public function up()
    {
        $this->createTable('user_progress', [
            'id' => $this->primaryKey(),
            'progress_key' => $this->string(128),
            'user_id' => $this->integer(11),
            'name' => $this->string(100),
            'image_id' => $this->integer(11),
            'short_description' => $this->string(100),
            'long_description' => $this->string(255)
        ]);

        $this->addForeignKey('user_progress_user_progress_images_fk',
            'user_progress', 'image_id',
            'user_progress_images', 'id',
            'CASCADE', 'CASCADE');
    }

    public function down()
    {
        echo "m160916_135550_create_user_progress cannot be reverted.\n";

        $this->dropForeignKey('user_progress_user_progress_images_fk',
            'user_progress');

        $this->dropTable('user_progress');

        return true;
    }
}
