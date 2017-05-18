<?php

namespace app\components;

use app\backend\models\DictWord;
use yii\web\UrlRuleInterface;
use yii\base\Object;

class WordsUrlManager extends Object implements UrlRuleInterface
{
    private $route = 'words';

    public function createUrl($manager, $route, $params)
    {
        return false;
    }

    public function parseRequest($manager, $request)
    {
        $pathInfo = $request->getPathInfo();


        if (preg_match('%^([a-zA-Z0-9-]+)(/([a-zA-Z0-9-]+))?$%', $pathInfo, $matches)) {

            if ((empty($matches[1])) || (empty($matches[3]))) {
                return false;
            }

            $rout ='';

            if ($this->route == $matches[1]) {
                if (($word = DictWord::findOne(['slug' => $matches[3]])) != NULL) {
                    $rout = $matches[3];
                }
            }

			if (!empty($rout)) {
				return ['/dictionary/default/words', ['word' =>$rout]];
			}
        }

        return false;
    }

}
