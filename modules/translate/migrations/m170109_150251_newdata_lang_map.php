<?php

use yii\db\Migration;
use app\backend\models\LangMap;

class m170109_150251_newdata_lang_map extends Migration
{
    public function up()
    {
        if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN')
            $SEPARATOR = "\\";
        else
            $SEPARATOR = "/";

        $file = Yii::getAlias('@app').$SEPARATOR.'messages'.$SEPARATOR.'ru-RU'.$SEPARATOR.'app.php';
        $translates = require($file);
        foreach ($translates as $key => $translate) {
            $m = new LangMap();
            $m->value = $key;
            $m->save();
        }
    }

    public function down()
    {
        LangMap::deleteAll();
    }

}
