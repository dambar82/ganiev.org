<?php

namespace app\modules\translate\controllers;

use app\models\Lang;
use app\modules\translate\helpers\TranslateHelper;
use app\modules\translate\models\LangMap;
use yii\helpers\ArrayHelper;
use yii\web\Controller;

/**
 * Default controller for the `translate` module
 */
class DefaultController extends Controller
{
    public function actionIndex()
    {
        $languages = Lang::find()->all();

        $mapping = ArrayHelper::map(LangMap::find()->all(),'value','id');

        $translates = TranslateHelper::getTranslate();

        return $this->render('index',[
            'model' => $translates,
            'languages' => $languages,
            'mapping' => $mapping
        ]);
    }
}
