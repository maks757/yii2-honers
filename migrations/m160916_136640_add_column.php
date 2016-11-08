<?php

use bl\progress\entities\UserProgress;
use bl\progress\entities\UserProgressImages;
use console\controllers\ProgressController;
use yii\db\Migration;

class m160916_136640_add_column extends Migration
{
    public function up()
    {
        $this->addColumn('user_progress_images', 'group', $this->integer());
        $this->addColumn('user_progress_images', 'position', $this->integer());

        $honors = Yii::$app->components['progress']['honors'];
        if(!empty($honor['group']) && !empty($honor['position'])) {
            foreach ($honors as $honor) {
                if ($data = UserProgressImages::find()->where(['name' => $honor['name']])->one()) {
                    $data->group = $honor['group'];
                    $data->position = $honor['position'];
                    $data->save();
                }
            }
        }
    }

    public function down()
    {
        echo "m160916_136640_add_column cannot be reverted.\n";
        $this->dropColumn('user_progress_images', 'group');
        $this->dropColumn('user_progress_images', 'position');
        return true;
    }
}
