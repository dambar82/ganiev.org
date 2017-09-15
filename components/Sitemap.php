<?php

namespace app\components;


use app\models\Lang;
use Yii;

class Sitemap
{
    protected $items = array();

    public function add($items)
    {
        $this->items = $items;
    }

    public function render()
    {
        $langs = Lang::find()->all();

        $fileHandler = fopen(\Yii::getAlias('@webroot/files/sitemap.xml'), 'w');
        fwrite(
            $fileHandler,
            "<?xml version=\"1.0\" encoding=\"UTF-8\"?>\n<urlset xmlns=\"http://www.sitemaps.org/schemas/sitemap/0.9\">\n"
        );

        foreach($this->items as $item) {
            fwrite($fileHandler, "\t<url>\n\t\t<loc>{$item['loc']}</loc>\n\t\t<changefreq>{$item['changefreq']}</changefreq>\n\t\t<priority>{$item['priority']}</priority>\n\t</url>\n");
        }

        fwrite($fileHandler, "</urlset>");
    }

}