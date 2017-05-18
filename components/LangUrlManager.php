<?php
namespace app\components;

use app\backend\models\DictWord;
use yii\web\UrlManager;
use app\models\Lang;

class LangUrlManager extends UrlManager
{
    public function createUrl($params)
    {
        if( isset($params['lang_id']) ){
            $lang = Lang::findOne($params['lang_id']);
            if( $lang === null ){
                $lang = Lang::getDefaultLang();
            }
            unset($params['lang_id']);
        } else {
            $lang = Lang::getCurrent();
        }

        $url = parent::createUrl($params);

        if( $url == '/' ){
            return '/'.$lang->url;
        }else{
            return '/'.$lang->url.$url;
        }
    }

    public function createWordUrl($params)
    {

        if(isset($params['word'])) {
            $w = DictWord::findOne($params['word']);
            return '/words/'.$w->slug;
        }
        return false;
    }
}