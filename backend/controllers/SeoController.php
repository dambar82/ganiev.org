<?php

namespace app\backend\controllers;

use app\models\Lang;
use app\models\SeoEav;
use app\models\Seo;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\backend\models\DictWord;
use app\components\Sitemap;
use yii\helpers\Url;
use Yii;
use yii\web\Response;

/**
 * SeoController implements the CRUD actions for Seo model.
 */
class SeoController extends Controller
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

    /**
     * Lists all Seo models.
     * @return mixed
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Seo::find(),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Seo model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Seo model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Seo();
        $languages = Lang::find()->all();

        $model_eav = [];
        foreach ($languages as $language) {
            $model_eav[$language->id] = new SeoEav();
        }

        $post = Yii::$app->request->post();
        if ($model->load($post)) {
            if (Seo::findOne(['page' => $model->page])) {
                $model = Seo::findOne(['page' => $model->page]);
                foreach ($languages as $language) {
                    if (($old = SeoEav::findOne(['lang_id' => $language->id, 'page_id' => $model->id])) != NULL) {
                        $model_eav[$language->id] = $old;
                    }
                }
            }
            $model->save();
            if (Model::loadMultiple($model_eav, $post)) {
                foreach ($model_eav as $key => $eav) {
                    /** @var SeoEav $eav */
                    $eav->lang_id = $key;
                    $eav->page_id = $model->id;
                    $eav->save(false);
                }
            }
            return $this->redirect(['view', 'id' => $model->id]);
        }
        return $this->render('create', [
            'model' => $model,
            'model_eav' => $model_eav
        ]);
    }

    /**
     * Updates an existing Seo model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $languages = Lang::find()->all();

        $model_eav = [];
        foreach ($languages as $language) {
            $model_eav[$language->id] = SeoEav::findOne([
                'lang_id' => $language->id,
                'page_id' => $id
            ]);
        }

        $post = Yii::$app->request->post();
        if ($post) {
            if (Model::loadMultiple($model_eav, $post)) {
                foreach ($model_eav as $key => $eav) {
                    /** @var SeoEav $eav */
                    $eav->save(false);
                }
            }
            return $this->redirect(['view', 'id' => $model->id]);
        }

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
                'model_eav' => $model_eav
            ]);
        }
    }

    /**
     * Deletes an existing Seo model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Seo model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Seo the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Seo::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionSitemap()
    {
        $sitemap = new Sitemap();

        $item = [
            ['loc' => Url::base(true), 'changefreq' => 'weekly', 'priority' => 0.5],
            ['loc' => Url::base(true).'/author', 'changefreq' => 'weekly', 'priority' => 0.5],
            ['loc' => Url::base(true).'/about', 'changefreq' => 'weekly', 'priority' => 0.5],
        ];

        $words = DictWord::find()->all();
        foreach ($words as $word) {
            $loc = Url::base(true).'/words/'.$word->slug;
            $item[] = ['loc' => $loc, 'changefreq' => 'weekly', 'priority' => 0.5];
        }

        $sitemap->add($item);
        $sitemap->render();
        return $this->render('sitemap');
    }
}
