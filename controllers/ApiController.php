<?php
/**
 * Created by PhpStorm.
 * User: User 50
 * Date: 15.03.2017
 * Time: 13:38
 */

namespace app\controllers;

use app\backend\models\DictDate;
use app\backend\models\DictWord;
use app\helpers\admin\AdminHelper;
use yii\helpers\Url;
use yii\rest\Controller;
use Yii;
use yii\web\NotFoundHttpException;
use yii\web\Response;

class ApiController extends Controller
{
    protected $validToken = '';

    public function actionUpdate() // проверить обновления
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $this->validToken = md5(md5(Yii::$app->params['apitoken']));

        $request = Yii::$app->request;
        $authHeader =  $request->getHeaders()->get('Authorization');

        if ($authHeader !== null && preg_match("/^Token\\s+(.*?)$/", $authHeader, $matches)) {
            if (md5($matches[1]) != $this->validToken) {
                Yii::$app->response->format = Response::FORMAT_HTML;
                throw new NotFoundHttpException('Page not found');
            }
        }
        else {
            Yii::$app->response->format = Response::FORMAT_HTML;
            throw new NotFoundHttpException('Page not found');
        }

        $words = DictWord::find()
            ->limit(100);

        $result = [];

        foreach ($words->each() as $key => $word) {
            $mean = [];
            $linkwords = [];
            /* @var $word DictWord */
            $result[$key]['id'] = $word->id;
            $result[$key]['word'] = trim($word->word);
            $result[$key]['accent'] = trim($word->accent);
            $result[$key]['italic'] = trim($word->italic);
            $result[$key]['ending'] = trim($word->ending);

            $meanings = $word->meaning;
            $links = $word->links;
            foreach ($meanings as $meankey => $meaning) {
                $examples = $meaning->examples;
                /* @var $meaning \app\backend\models\DictMeaning */
                $mean[$meankey]['title'] = trim($meaning->description);
                $mean[$meankey]['description'] = trim($meaning->russian_description);
                $mean[$meankey]['italic'] = trim($meaning->italic);
                $mean[$meankey]['audio'] = Url::base(true).'/files/audio/'.$meaning->audio_id;
                $mean[$meankey]['examples'] = [];
                foreach ($examples as $examplekey => $example) {
                    $mean[$meankey]['examples'][$examplekey]['russian'] = trim($example->rus_value);
                    $mean[$meankey]['examples'][$examplekey]['tatar'] = trim($example->tat_value);
                    $mean[$meankey]['examples'][$examplekey]['type'] = $example->type ==0 ? 'Пример' : 'Идиома';
                }
            }
            foreach ($links as $linkkey => $link) {
                $linkwords[$linkkey]['link'] = $link->link_word_id;
                $linkwords[$linkkey]['link_text'] = trim($link->value);
            }
            $result[$key]['meaning'] = $mean;
            $result[$key]['links'] = $linkwords;
        }

        return $result;
    }

    public function actionDate()
    {
        $this->validToken = md5(md5(Yii::$app->params['apitoken']));

        $request = Yii::$app->request;
        $authHeader = $request->getHeaders()->get('Authorization');

        if ($authHeader !== null && preg_match("/^Token\\s+(.*?)$/", $authHeader, $matches)) {
            if (md5($matches[1]) != $this->validToken) {
                Yii::$app->response->format = Response::FORMAT_HTML;
                throw new NotFoundHttpException('Page not found');
            }
        } else {
            Yii::$app->response->format = Response::FORMAT_HTML;
            throw new NotFoundHttpException('Page not found');
        }

        $dates = DictDate::findOne(1);

        $words = DictWord::find();

        if ($date = Yii::$app->request->get('date')) {
            $date = intval($date);
            $words = $words->andWhere(['>=','date_update', $date]);
        }

        $count = $words->count();

        Yii::$app->response->format = Response::FORMAT_JSON;

        return [
            'count' => $count,
            'date' => $dates->date
        ];
    }

    public function actionUp()
    {
        $this->validToken = md5(md5(Yii::$app->params['apitoken']));

        $request = Yii::$app->request;
        $authHeader =  $request->getHeaders()->get('Authorization');

        if ($authHeader !== null && preg_match("/^Token\\s+(.*?)$/", $authHeader, $matches)) {
            if (md5($matches[1]) != $this->validToken) {
                Yii::$app->response->format = Response::FORMAT_HTML;
                throw new NotFoundHttpException('Page not found');
            }
        }
        else {
            Yii::$app->response->format = Response::FORMAT_HTML;
            throw new NotFoundHttpException('Page not found');
        }

        $words = DictWord::find()->with('meaning.examples', 'links');
        if ($offset = Yii::$app->request->get('offset'))
            $words->offset($offset);

        if ($date = Yii::$app->request->get('date')) {
            $date = intval($date);
            $words = $words->andWhere(['>=','date_update', $date]);
        }

        Yii::$app->response->format = Response::FORMAT_JSON;

        $words->limit(1000);
        $result = [];

        foreach ($words->each() as $key => $word) {
            $mean = [];
            $linkwords = [];
            /* @var $word DictWord */
            $result[$key]['id'] = $word->id;
            $result[$key]['word'] = trim($word->word);
            $result[$key]['accent'] = trim($word->accent);
            $result[$key]['italic'] = trim($word->italic);
            $result[$key]['ending'] = trim($word->ending);

            $meanings = $word->meaning;
            $links = $word->links;
            foreach ($meanings as $meankey => $meaning) {
                $examples = $meaning->examples;
                /* @var $meaning \app\backend\models\DictMeaning */
                $mean[$meankey]['title'] = trim($meaning->description);
                $mean[$meankey]['description'] = trim($meaning->russian_description);
                $mean[$meankey]['italic'] = trim($meaning->italic);
                $mean[$meankey]['audio'] = Url::base(true).'/files/audio/'.$meaning->audio_id;
                $mean[$meankey]['examples'] = [];
                foreach ($examples as $examplekey => $example) {
                    $mean[$meankey]['examples'][$examplekey]['russian'] = trim($example->rus_value);
                    $mean[$meankey]['examples'][$examplekey]['tatar'] = trim($example->tat_value);
                    $mean[$meankey]['examples'][$examplekey]['type'] = $example->type ==0 ? 'Пример' : 'Идиома';
                }
            }
            foreach ($links as $linkkey => $link) {
                $linkwords[$linkkey]['link'] = $link->link_word_id;
                $linkwords[$linkkey]['link_text'] = trim($link->value);
            }
            $result[$key]['meaning'] = $mean;
            $result[$key]['links'] = $linkwords;
        }

        return $result;
    }
}