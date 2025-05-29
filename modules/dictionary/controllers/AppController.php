<?php

namespace app\modules\dictionary\controllers;

use app\backend\models\DictExamples;
use app\backend\models\DictLinks;
use app\backend\models\DictMeaning;
use app\backend\models\DictWord;
use app\backend\models\Info;
use app\backend\models\InfoAboutAuthor;
use app\backend\models\Photo;
use app\backend\models\Quotations;
use app\backend\models\Video;
use app\models\Lang;
use app\models\Seo;
use Yii;
use yii\db\Expression;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;


class AppController extends Controller
{
    public function actionIndex()
    {
        $quotations = Quotations::find()->all();
        $dict_words = DictWord::find()->all();
        $dict_meanings = DictMeaning::find()->all();
        $dict_links = DictLinks::find()->all();
        $dict_examples = DictExamples::find()->all();


        return $this->asJson([
            'quotations' => $quotations,
            'dict_words' => $dict_words,
            'dict_meanings' => $dict_meanings,
            'dict_links' => $dict_links,
            'dict_examples' => $dict_examples,
        ]);
    }

    public function actionAutocomplete()
    {
        if (($search = Yii::$app->request->get('q')) == NULL) {
            $search = 'а';
        }
        $search = preg_replace("/[^а-яё]+/msiu", '', $search);

        $words = DictWord::find()->where(['like', 'word', mb_strtolower($search).'%', false])->groupBy('word')->all();

        if (count($words) > 0) {
            $results = ArrayHelper::map($words,'id','word');
        } else {
            $results = array(0 => 'Нет совпадений');
        }

        return json_encode($results);
    }

    public function actionAbout()
    {
        $model = Info::findOne(['id' => 2]);



        Seo::setSeo('about', Lang::getCurrent()->id, '/about/');

        return $this->render('about',[
            'model' => $model,
        ]);
    }

    public function actionAuthor()
    {
        $model = Info::findOne(['id' => 1]);

        Seo::setSeo('author', Lang::getCurrent()->id, '/author');

        return $this->asJson([
            'model' => $model,
            'comments' => InfoAboutAuthor::find()->all(),
            'nasledie' => (Info::findOne(['id' => 3]) ? Info::findOne(['id' => 3]) : new Info()),
            'photos' => Photo::find()->all(),
            'videos' => Video::find()->all()
        ]);
    }

    public function actionSearch()
    {
        if (Yii::$app->request->isPost) {
            $search = Yii::$app->request->post('search');
            if (!empty($search)) {
                if (($word = DictWord::findOne(['word' => mb_strtolower($search)])) != NULL) {
                    $url = Yii::$app->urlManager->createUrl('/words/'.$word->slug, array('lang_id'=>Lang::getCurrent()->id));
                    return $this->redirect($url);
                }
            }
        }

        return $this->asJson([
            'message' => 'Слово отсутствует в словаре',
            'results' => null,
            'word' => $search,
            'random_result' => null,
            'reducto' => false,
            'mobile' => true,
        ]);

        //throw new NotFoundHttpException();
    }

    public function actionWords($word = NULL)
    {
        $result = '';
        $reducto = true;
        $llang = Lang::getCurrent();

        $random_result = Quotations::find()
            ->where(['lang_id' => $llang->id])
            ->orderBy(new Expression('rand()'))
            ->limit(1)
            ->one();

        if (!isset($word)) {
            throw new NotFoundHttpException();
        }

        if (($words = DictWord::findAll(['slug' => $word])) == NULL) {
            throw new NotFoundHttpException();
        }

        foreach ($words as $key => $thisword) {
            $links = DictLinks::findAll(['word_id' => $thisword->id]);
            $meanings = DictMeaning::findAll(['word_id' => $thisword->id]);

            $result[$key]['word'] = $thisword;
            $result[$key]['meaning'] = $meanings;
            $result[$key]['links'] = $links;

            foreach ($meanings as $mean_key => $mean_value) {
                $example = DictExamples::findAll(['word_id' => $thisword->id,'meaning_id' => $mean_value->id]);
                $result[$key]['examples'][$mean_key] = ($example ? $example : NULL);
                if ($example) {
                    foreach ($example as $exa) {
                        /** @var $exa DictExamples */
                        $metaKeywords[] = trim($exa->rus_value);
                    }
                }
            }
        }
        $metaKeywords[] = $thisword->word;

        Seo::setSeo('words', Lang::getCurrent()->id, '/words/'.$word, implode(',', $metaKeywords).',по татарски, с русского, перевод, русский, татарский, онлайн, озвученный, слова, словарь', $thisword->word);

        return $this->asJson([
            'results' => $result,
            'word' => $thisword->word,
            'random_result' => $random_result,
            'reducto' => $reducto,
            'mobile' => false,
            'message' => null
        ]);
    }

}
