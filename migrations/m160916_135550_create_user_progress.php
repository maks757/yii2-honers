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
            'image' => $this->string(60),
            'short_description' => $this->string(100),
            'long_description' => $this->string(255)
        ]);
    }

    public function down()
    {
        echo "m160916_135550_create_user_progress cannot be reverted.\n";

        $this->dropTable('user_progress');

        return true;
    }
}
