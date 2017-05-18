<?php

namespace app\backend\controllers;

use Yii;
use app\backend\models\Info;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * InfoController implements the CRUD actions for Info model.
 */
class InfoController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    public function actionCreate()
    {
        $model = new Info();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $image = $model->image_id;
        if ($model->load(Yii::$app->request->post())) {

            if (($file = UploadedFile::getInstance($model, 'image_id')) != NULL) {
                $model->image_id = 'author.'.$file->extension;
                $file->saveAs('files/'.$model->image_id);
            }
            if (empty($model->image_id)) {
                $model->image_id = $image;
            }
            $model->save();
            return $this->redirect('/backend');
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }


    protected function findModel($id)
    {
        if (($model = Info::findOne($id)) !== null) {
            return $model;
        } else {
            return new Info();
        }
    }
}
