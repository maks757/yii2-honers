<?php

use yii\db\Migration;

class m160916_135419_create_honor_translation extends Migration
{
    public function up()
    {
        $this->createTable('honor_translation', [
            'id' => $this->primaryKey(),
            'honor_id' => $this->integer(11),
            'language_id' => $this->integer(11),
            'translation' => $this->string(100),
            'short_description' => $this->string(100),
            'long_description' => $this->string(255),
        ]);

        
    }

    public function down()
    {
        echo "m160916_135419_create_honor_translation cannot be reverted.\n";

        $this->dropTable('honor_translation');

        return true;
    }
}
