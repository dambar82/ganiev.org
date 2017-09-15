<?php

namespace app\models;

use Yii;
use yii\helpers\Url;

/**
 * This is the model class for table "seo".
 *
 * @property integer $id
 * @property integer $page
 */
class Seo extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'seo';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['page'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'page' => 'Страница',
        ];
    }

    public static function setSeo($name, $lang, $canonical, $keywords = NULL, $word = NULL)
    {
        $result_array = [
            'title' => Yii::t('app','Русско-татарский словарь Ганиева Ф.А.'),
            'description' => Yii::t('app','Первый озвученный русско-татарский онлайн-словарь'),
            'keywords' => $keywords
        ];
        $langs = Lang::getCurrent();
        if ($name == 'words') {
            if ($langs->url == 'ru') {
                $translate = Yii::t('app','Перевод слова') . ' ' . $word;
            } else {
                $translate = \app\helpers\SlugHelper::mb_ucfirst(trim($word));
            }
            $title = Yii::t('app','Перевод') . ' ' . $word . ' | ' . Yii::t('app','Русско-татарский словарь Ганиева Ф.А.');
            $description = $translate . ' ' . Yii::t('app','с русского на татарский язык');
            $result_array = [
                'title' => $title,
                'description' => $description,
                'keywords' => $keywords
            ];
        }

        $page = Pages::findOne(['name' => $name]);
        if (!$page) {
            (static::setMeta($result_array['title'], $result_array['description'], $result_array['keywords'], $canonical));
            return $result_array;
        }

        $seoEntity = Seo::findOne([
            'page' => $page->id
        ]);

        if (!$seoEntity) {
            (static::setMeta($result_array['title'], $result_array['description'], $result_array['keywords'], $canonical));
            return $result_array;
        }

        $eavs = SeoEav::findOne([
            'page_id' => $seoEntity->id,
            'lang_id' => $lang
        ]);


        if (!$eavs) {
            (static::setMeta($result_array['title'], $result_array['description'], $result_array['keywords'], $canonical));
            return $result_array;
        }

        (static::setMeta($eavs->title, $eavs->description, $eavs->keywords, $canonical));
        return false;

    }

    protected static function setMeta($title, $description, $keywords, $canonical)
    {
        Yii::$app->view->title = $title;
        Yii::$app->view->registerMetaTag(['description' => $description]);
        if ($keywords) Yii::$app->view->registerMetaTag(['keywords' => $keywords]);

        $langs = Lang::find()->all();
        $currentLang = Lang::getCurrent();

        if ($currentLang->url == 'ru') {
            Yii::$app->view->registerLinkTag(['rel' => 'canonical',  'href' => Url::base(true).$canonical]);
        }

        foreach ($langs as $lang) {
            Yii::$app->view->registerLinkTag(['rel' => 'alternate', 'hreflang' => $lang->url, 'href' => Url::base(true).'/'.$lang->url.$canonical]);
        }
    }
}
