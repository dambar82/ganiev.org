<?php

namespace app\modules\mobile\controllers;

use app\backend\models\DictExamples;
use app\backend\models\DictLinks;
use app\backend\models\DictMeaning;
use app\backend\models\DictWord;
use app\backend\models\Quotations;
use yii\web\Controller;
use Yii;

/**
 * Default controller for the `mobile` module
 */
class DefaultController extends Controller
{
    public function actionIndex()
    {
        $this->enableCsrfValidation = false;

        $error_message = '';
        $result = '';
        $reducto = false;

        $random_count = Quotations::find()->count();
        $random_result = false;

        if ($random_count > 0) {
            $random_index = rand(1, $random_count);
            $random_result = Quotations::findOne($random_index);
        }

        if (((Yii::$app->request->isPjax)) | (!empty(Yii::$app->request->post('search')))){

            $search = mb_strtolower(Yii::$app->request->post('search'));
            $words = DictWord::findAll(['word' => $search]);
            if (count($words) == 0) {
                $error_message = Yii::t('app','К сожалению, по вашему запросу ничего не найдено');
                return $this->renderAjax('@app/modules/dictionary/views/default/index',[
                    'message' => $error_message,
                    'word' => $search,
                    'results' => null,
                    'random_result' => $random_result,
                    'reducto' => $reducto,
                    'mobile' => true,
                ]);
            }
            else {
                $reducto = true;

                foreach ($words as $key => $word) {
                    $links = DictLinks::findAll(['word_id' => $word->id]);
                    $meanings = DictMeaning::findAll(['word_id' => $word->id]);

                    $result[$key]['word'] = $word;
                    $result[$key]['meaning'] = $meanings;
                    $result[$key]['links'] = $links;

                    foreach ($meanings as $mean_key => $mean_value) {
                        $example = DictExamples::findAll(['word_id' => $word->id,'meaning_id' => $mean_value->id]);
                        $result[$key]['examples'][$mean_key] = ($example ? $example : NULL);
                    }
                }

                return $this->render('@app/modules/dictionary/views/default/index',[
                    'message' => $error_message,
                    'results' => $result,
                    'word' => $search,
                    'random_result' => $random_result,
                    'reducto' => $reducto,
                    'mobile' => true,
                ]);
            }
        }

        if (Yii::$app->request->isPost) {
            $reducto = true;

            if (($id = Yii::$app->request->get('id')) == NULL) {
                return $this->render('@app/modules/dictionary/views/default/index',[
                    'message' => $error_message,
                    'results' => $result,
                    'random_result' => $random_result,
                    'reducto' => $reducto,
                    'mobile' => true,
                ]);
            }

            $words = DictWord::findAll(['id' => $id]);

            foreach ($words as $key => $word) {
                $links = DictLinks::findAll(['word_id' => $word->id]);
                $meanings = DictMeaning::findAll(['word_id' => $word->id]);

                $result[$key]['word'] = $word;
                $result[$key]['meaning'] = $meanings;
                $result[$key]['links'] = $links;

                foreach ($meanings as $mean_key => $mean_value) {
                    $example = DictExamples::findAll(['word_id' => $word->id,'meaning_id' => $mean_value->id]);
                    $result[$key]['examples'][$mean_key] = ($example ? $example : NULL);
                }
            }

            return $this->render('@app/modules/dictionary/views/default/index',[
                'message' => $error_message,
                'results' => $result,
                'word' => ($words[0]->word ? $words[0]->word : ''),
                'random_result' => $random_result,
                'reducto' => $reducto,
                'mobile' => true,
            ]);
        }

        return $this->render('@app/modules/dictionary/views/default/index',[
            'message' => $error_message,
            'results' => $result,
            'random_result' => $random_result,
            'reducto' => $reducto,
            'mobile' => true,
        ]);
    }
}
