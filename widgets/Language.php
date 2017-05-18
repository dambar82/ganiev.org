<?php

namespace app\widgets;

use app\models\Lang;


class Language extends \yii\bootstrap\Widget
{
    public function init(){}

    public function run() {
        return $this->render('language', [
            'current' => Lang::getCurrent(),
            'langs' => Lang::find()->all(),
        ]);
    }
}