<?php

namespace app\modules\translate\helpers;

use app\modules\translate\models\LangMap;
use app\models\Lang;
use Yii;
use yii\helpers\ArrayHelper;
use yii\helpers\VarDumper;

class TranslateHelper
{

    public static function getTranslate()
    {
        $message_dir = Yii::getAlias('@app/messages/');

        $languages = Lang::find()->all();
        $translates = [];

        $mapping = ArrayHelper::map(LangMap::find()->orderBy(['value' => SORT_DESC])->all(),'value','id');

        foreach ($languages as $language)
        {
            $local_dir = $message_dir.$language->local;
            $filename = $local_dir.'/app.php';
            if (!file_exists($local_dir)) {
                mkdir($local_dir);
            }

            if (!file_exists($filename)) {
                file_put_contents($filename, "<?php\nreturn " . VarDumper::export([]) . ";\n", LOCK_EX);
            }

            $translate = require($filename);

            foreach ($mapping as $key => $value) {
                if (!isset($translate[$key])) {
                    $translates[$language->id][$key] = '';
                }
                else {
                    if (is_array($translate[$key])) {
                        $s = '[';
                        $count = count($translate[$key]) - 1;
                        $index = 0;
                        foreach ($translate[$key] as $item) {
                            if ($index < $count) {
                                $s .= '"'.$item . '",';
                            }
                            else {
                                $s .= '"'.$item.'"';
                            }
                            $index++;
                        }
                        $translate[$key] = $s.']';

                        if ($translate[$key] == "[]") {
                            $translate[$key] = '[" "]';
                        }
                    }
                    $translates[$language->id][$key] = $translate[$key];
                }
            }
        }
        return $translates;
    }
}
