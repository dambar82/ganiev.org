<?php

namespace app\modules\project\assets;

use yii\web\AssetBundle;

/**
 * Main application asset bundle.
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class ProjectAsset extends AssetBundle
{
    public $sourcePath = '@projectModule/assets';

    public $css = [
        "css/site.css"
    ];
    public $js = [
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
    public $publishOptions = [
        'forceCopy' => true,
        'appendTimestamp' => false,
    ];

    public $jsOptions = [
        'appendTimestamp' => false,
    ];
}
