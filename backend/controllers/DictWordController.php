<?php

namespace app\backend\controllers;

use app\backend\models\DictDate;
use app\backend\models\DictExamples;
use app\backend\models\DictLinks;
use app\backend\models\DictMeaning;
use app\helpers\admin\AdminHelper;
use app\helpers\SlugHelper;
use Yii;
use app\backend\models\DictWord;
use app\backend\models\DictWordSearch;
use yii\base\Model;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * DictWordController implements the CRUD actions for DictWord model.
 */
class DictWordController extends Controller
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
     * Lists all DictWord models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new DictWordSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single DictWord model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        if (Yii::$app->request->post()) {
            $meaning_count = count(Yii::$app->request->post('DictMeaning', []));
            foreach (Yii::$app->request->post('DictMeaning') as $post) {
                $meaning = new DictMeaning();
                $meaning->word_id = $id;
                $meaning->description = $post['description'];
                $meaning->russian_description = $post['russian_description'];
                $meaning->italic = $post['italic'];
                $meaning->save();
            }
            return $this->refresh();
        }


        return $this->render('view', [
            'model' => $this->findModel($id),
            'meanings' => DictMeaning::findAll(['word_id' => $id]),
            'examples' => DictExamples::findAll(['word_id' => $id])
        ]);
    }

    /**
     * Finds the DictWord model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return DictWord the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = DictWord::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    /**
     * Creates a new DictWord model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new DictWord();
        $meaning[] = new DictMeaning();
        $examples[] = new DictExamples();

        if ($model->load(Yii::$app->request->post())) {

            $meaning_count = count(Yii::$app->request->post('DictMeaning', []));
            $examples_count = count(Yii::$app->request->post('DictExamples', []));

            unset($meaning);
            unset($examples);

            for($i = 0; $i < $meaning_count; $i++) {
                $meaning[] = new DictMeaning();
            }
            Model::loadMultiple($meaning, Yii::$app->request->post());

            for($j = 0; $j < $examples_count; $j++) {
                $examples[] = new DictExamples();
            }
            Model::loadMultiple($examples, Yii::$app->request->post());


            $transaction = DictWord::getDb()->beginTransaction();
            try {
                $model->slug = SlugHelper::latin($model->word);
                $model->save(false);
                foreach ($meaning as $mean) {
                    if (!empty($mean->description)) {
                        $mean->word_id = $model->id;
                        $mean->save(false);
                    }
                }

                foreach ($examples as $example) {
                    if ($example->rus_value) {
                        $example->word_id = $model->id;
                        $example->save(false);
                    }
                }

                $dates = DictDate::findOne(1);
                $dates->date = $model->date_update;
                $dates->save();

                $transaction->commit();
                return $this->redirect(['view', 'id' => $model->id]);
            } catch (\Exception $e) {
                $transaction->rollBack();
                throw $e;
            } catch (\Throwable $e) {
                $transaction->rollBack();
                throw $e;
            }
        }
        return $this->render('create', [
                'model' => $model,
                'meaning' => $meaning,
                'examples' => $examples
            ]);
    }

    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if (($meaning = DictMeaning::find()->where(['word_id' => $id])->all()) == NULL) {
            $meaning[] = new DictMeaning();
        }
        if (($examples = DictExamples::find()->where(['word_id' => $id])->all()) == NULL) {
            $examples[] = new DictExamples();
        }

        if ($model->load(Yii::$app->request->post())) {
            $meaning_count = count(Yii::$app->request->post('DictMeaning', []));
            $examples_count = count(Yii::$app->request->post('DictExamples', []));

            unset($examples);

            for($j = 0; $j < $examples_count; $j++) {
                $examples[] = new DictExamples();
            }

            $postMean = Yii::$app->request->post('DictMeaning');

            Model::loadMultiple($examples, Yii::$app->request->post());

            $transaction = DictWord::getDb()->beginTransaction();
            try {
                if ($model->status == 1) {
                    $model->edit_status = 2;
                }
                $model->slug = SlugHelper::latin($model->word);
                $model->date_update = time();
                $model->save(false);

                //DictMeaning::deleteAll(['word_id' => $model->id]);
                DictExamples::deleteAll(['word_id' => $model->id]);

                foreach ($meaning as $key => $mean) {
                    if (!empty($postMean[$key]['description'])) {
                        $mean->description = $postMean[$key]['description'];
                        $mean->word_id = $model->id;
                        $mean->italic = $postMean[$key]['italic'];
                        $mean->russian_description = $postMean[$key]['russian_description'];
                        $mean->audio_id = ($postMean[$key]['audio_id'] ? $postMean[$key]['audio_id'] : $mean->audio_id );
                        $mean->save(false);
                    }
                }

                foreach ($examples as $example) {
                    if ($example->rus_value) {
                        $example->word_id = $model->id;
                        $example->save(false);
                    }
                }

                $dates = DictDate::findOne(1);
                $dates->date = $model->date_update;
                $dates->save();

                $transaction->commit();

                if ($model->audio_status != 2) {
                    $meanings_array = DictMeaning::findAll(['word_id' => $id]);
                    $sc = 0;
                    foreach ($meanings_array as $mean_array) {
                        if ($mean_array->audio_id) {
                            $sc++;
                        }
                    }
                    if ($sc == count($meanings_array)) {
                        $word_array = DictWord::findOne($id);
                        $word_array->audio_status = 2;
                        $word_array->save();
                    }
                }

                return $this->redirect(['/backend/dict-word/view', 'id' => $model->id]);
            } catch (\Exception $e) {
                $transaction->rollBack();
                throw $e;
            } catch (\Throwable $e) {
                $transaction->rollBack();
                throw $e;
            }
        }
        return $this->render('update', [
            'model' => $model,
            'meaning' => $meaning,
            'examples' => $examples
        ]);

    }

    /**
     * Deletes an existing DictWord model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    public function actionCreateLink($id)
    {
        $link = new DictLinks();
        $link->word_id = $id;

        if ($link->load(Yii::$app->request->post())) {
            $model = DictWord::findOne($link->link_word_id);
            $link->value = $model->word;
            $link->save();
            return $this->redirect(['/backend/dict-word/view', 'id' => $id]);
        }

        return $this->render('link',[
            'model' => $link,
            'lid' => $id,
        ]);
    }
}
