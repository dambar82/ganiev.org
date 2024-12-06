<?php

namespace app\modules\project\controllers;

use app\backend\models\Alphabet;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

/**
 * Default controller for the `project` module
 */
class DefaultController extends Controller
{


    public function actionIndex($id)
    {
        $id = intval($id);
        if (($model = Alphabet::findOne($id)) == null) {
            throw new NotFoundHttpException();
        }



        return $this->render('index', [
            'model' => $model
        ]);
    }
}
