<?php

namespace app\backend\controllers;

use app\backend\models\DictMeaning;
use app\backend\models\DictWord;
use Yii;
use yii\db\Query;

class AjaxController extends \yii\web\Controller
{
    public function actionDeleteMeaning()
    {
        if (Yii::$app->request->isAjax) {
            Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
            $meaning_id = Yii::$app->request->post('meaning_id');
            DictMeaning::deleteAll(['id' => $meaning_id]);
            return true;
        }
        return false;
    }

    public function actionGenerateMeaning()
    {
        if (Yii::$app->request->isAjax) {
            $meaning_id = Yii::$app->request->post('seq');
            return $this->renderAjax('_add_meaning_form',['seq_index' => $meaning_id]);
        }
        return false;
    }

    public function actionGenerateExample()
    {
        if (Yii::$app->request->isAjax) {
            $example_id = Yii::$app->request->post('seq');
            $word_id = Yii::$app->request->post('word');
            return $this->renderAjax('_add_example_form',['seq_index' => $example_id,'word_id' => $word_id]);
        }
        return false;
    }
    public function actionLoadLinks($q = null, $id = null)
    {
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $out = ['results' => ['id' => '', 'text' => '']];
        if (!is_null($q)) {
            $query = new Query();
            $query->select('id, word AS text')
                ->from('dict_word')
                ->where(['like', 'word', $q.'%', false])
                ->orderBy('word ASC')
                ->limit(20);
            $command = $query->createCommand();
            $data = $command->queryAll();
            $out['results'] = array_values($data);
        }
        elseif ($id > 0) {
            $out['results'] = ['id' => $id, 'text' => DictWord::find($id)->word];
        }
        return $out;
    }

}
