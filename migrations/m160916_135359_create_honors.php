<?php

use yii\db\Migration;

class m160916_135359_create_honors extends Migration
{
    public function up()
    {
        $this->createTable('honors', [
            'id' => $this->primaryKey(),
            'user_honor_id' => $this->integer(11),
            'validator_classname' => $this->string(255),
            'image' => $this->string(100),
            'priority' => $this->integer(11),
            'show' => $this->boolean()->defaultValue(true)
        ]);
    }

    public function down()
    {
        echo "m160916_135359_create_honors cannot be reverted.\n";

        $this->dropTable('honors');

        return true;
    }
}
