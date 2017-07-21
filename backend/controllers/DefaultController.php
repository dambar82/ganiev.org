<?php

namespace app\backend\controllers;

use app\backend\models\DictLinks;
use app\backend\models\DictMeaning;
use app\backend\models\DictWord;
use app\helpers\admin\AdminHelper;
use app\helpers\SlugHelper;
use yii\web\Controller;

/**
 * Default controller for the `backend` module
 */
class DefaultController extends Controller
{
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionAudioStatus()
    {

        $words = DictWord::find()->where(['audio_status' => 0])->all();
        foreach ($words as $word) {
            $meaning_audio = DictMeaning::find()->where(['word_id' => $word->id])->andWhere(['!=', 'audio_id', ''])->count();
            $meaning_all = DictMeaning::find()->where(['word_id' => $word->id])->count();

            if ($meaning_all == $meaning_audio) {
                $word->audio_status = 2;
                $word->save();
            } else {
                if ($meaning_audio == 0) {
                    echo $word->word . '<br>';
                    $word->audio_status = 0;
                    $word->save();
                } else {
                    $word->audio_status = 1;
                    $word->save();
                }

            }
        }
    }

    public function actionSm()
    {
        $meanings = DictMeaning::find()->where(['like','description','см.'])->all();
        foreach ($meanings as $meaning) {
            $expl = explode(' ',$meaning->description);
            if (count($expl) <= 2) {
                $value = explode('.',$meaning->description);
                $russian_value = preg_replace("/[^а-яё\-]+/msiu", '', $value[1]);

                $search_word = DictWord::findOne(['word' => $russian_value]);
                if ($search_word) {
                    $links = new DictLinks();
                    $links->word_id = $meaning->word_id;
                    $links->link_word_id = $search_word->id;
                    $links->value = $russian_value;
                    $links->save();
                    DictMeaning::deleteAll(['id' => $meaning->id]);
                }
                else {
                    $delete_word = $meaning->word_id;
                    DictWord::deleteAll(['id' => $delete_word]);
                    DictMeaning::deleteAll(['id' => $meaning->id]);
                    echo '<div style="color:red">'.' '.$meaning->description.'</div>';
                }
            }

            if (count($expl) > 2) {
                $value = explode('.',$meaning->description);
                $word = DictWord::findOne($meaning->word_id);

                $russian_value = preg_replace("/[^а-яё\-]+/msiu", '', $value[1]);
                if (($model = DictWord::findOne(['word' => $russian_value])) != NULL) {
                    $links = new DictLinks();
                    $links->word_id = $meaning->word_id;
                    $links->link_word_id = $model->id;
                    $links->value = $russian_value;
                    $links->save();
                    DictMeaning::deleteAll(['id' => $meaning->id]);
                    echo '<div style="color:green">'.$word->word.' ->'.$meaning->description.'</div>';
                }
                else {
                    $word = DictWord::findOne($meaning->word_id);
                    echo '<div style="color:blue">'.$word->word.' -> '.$meaning->description.'</div>';
                }

            }
        }
        echo AdminHelper::pre($meanings);
        //return $this->render('index');
    }

    public function actionSlug()
    {
        $words = DictWord::find()->where(['like','word', 'ё'])->all();
echo AdminHelper::pre($words);
        foreach ($words as $word) {
            $word->slug = SlugHelper::latin($word->word);
            $word->save(false);
        }
    }
}
