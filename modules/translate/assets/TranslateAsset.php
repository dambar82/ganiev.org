<?php
namespace app\modules\translate\assets;

use yii\web\AssetBundle;

class TranslateAsset extends AssetBundle
{
    public $sourcePath = '@app/modules/translate/assets';
    public $css = [
    ];
    public $js = [
        'js/translate.js'
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapPluginAsset',
    ];
}
