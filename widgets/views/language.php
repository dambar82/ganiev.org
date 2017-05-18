<?php
use app\models\Lang;

/* @var $current \app\models\Lang */
/* @var $langs \app\models\Lang */

$current_lang = Lang::getCurrent();
?>

<div class="container-fluid">
    <div class="row">
        <div class="lang-block pull-right">
            <div class="col-xs-12">
                <div class="lang-block-title">
                    <span class="field-content"><?=Yii::t('app', 'Выбор языка')?></span>
                </div>
                <ul class="lang-cont">
                    <?php foreach ($langs as $lang) :?>
                        <li class="lang-link <?=($current_lang->id == $lang->id ? 'active' : '')?>">
                            <a class="<?= $lang->url ?>" href="<?='/'.$lang->url.Yii::$app->getRequest()->getLangUrl()?>"><?=Yii::t('app',$lang->name)?></a>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>
        </div>
    </div>
</div>
