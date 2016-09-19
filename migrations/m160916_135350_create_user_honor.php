<?php

use yii\db\Migration;

class m160916_135350_create_user_honor extends Migration
{
    public function up()
    {
        $this->createTable('user_honor', [
            'id' => $this->primaryKey(),
            'model_id' => $this->integer(11),
            'date_create' => $this->integer(11),
            'date_update' => $this->integer(11)
        ]);
    }

    public function down()
    {
        echo "m160916_135350_create_user_honor cannot be reverted.\n";

        $this->dropTable('user_honor');

        return true;
    }
}
