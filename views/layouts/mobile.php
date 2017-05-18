<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use app\models\Lang;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <div class="head-lang">
        <?=\app\widgets\Language::widget()?>
    </div>

    <div id="head">
        <div class="container-fluid">
            <div class="row">
                <div class="logo">
                    <a class="img-responsive" href="/mobile/"><img src="<?=Yii::getAlias('@web')?>/img/logo.png" alt="Русско-татарский словарь Ганиева Ф.А."></a>
                </div>
                <div class="title-block">
                    <div class="first-row">
                        <span><?=Yii::t('app','Электронный')?></span>
                    </div>
                    <div class="second-row">
                        <span><?=Yii::t('app','Русско-татарский словарь')?></span>
                    </div>
                    <div class="third-row">
                        <span><?=Yii::t('app','Ганиева Ф.А.')?></span>
                    </div>
                </div>
                <div class="pull-right mobile-btn-block">
                    <div class="mobile-btn"></div>
                </div>
            </div>
        </div>
    </div>
    <div class="main-menu">
        <div class="container-fluid">
            <div class="row">
                <div class="col-xs-12">
                    <ul class="nav nav-pills">
                        <li class="<?= (isset($this->params['main']) ? $this->params['main'] : '')?>"><a href="/mobile/<?=Lang::getCurrent()->url?>"><?=Yii::t('app','Словарь')?></a></li>
                        <li class="<?= (isset($this->params['autho']) ? $this->params['autho'] : '')?>"><a href="<?=\yii\helpers\Url::to('/'.Lang::getCurrent()->url.'/dictionary/default/author/')?>"><?=Yii::t('app','Об авторе')?></a></li>
                        <li class="<?= (isset($this->params['about']) ? $this->params['about'] : '')?>"><a href="<?=\yii\helpers\Url::to('/'.Lang::getCurrent()->url.'/dictionary/default/about/')?>"><?=Yii::t('app','О проекте')?></a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row">
            <div class="col-xs-12">
                <div class="content-body">
                    <?= Breadcrumbs::widget([
                        'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                    ]) ?>
                    <?= $content ?>

                </div>
            </div>
        </div>
    </div>
    <div class="white-bg">
        <div></div>
    </div>
</div>

<div class="footer">
    <div class="container-fluid">
        <div class="row">
            <div class="first-footer">
                <div class="inside-footer-cont">
                    <div class="logo">
                        <a class="img-responsive" href="/mobile/"><img src="<?=Yii::getAlias('@web')?>/img/footer_logo.png" alt="Русско-татарский словарь Ганиева Ф.А."></a>
                    </div>
                    <div class="title-block">
                        <div class="first-row">
                            <span><?=Yii::t('app','Электронный')?></span>
                        </div>
                        <div class="second-row">
                            <span><?=Yii::t('app','Русско-татарский словарь')?></span>
                        </div>
                        <div class="third-row">
                            <span><?=Yii::t('app','Ганиева Ф.А.')?></span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="second-footer">
                <div class="inside-footer-cont">
                    <div class="block-izdat">
                        <p>© <?=Yii::t('app','ТАТАРСКОЕ ДЕТСКОЕ ИЗДАТЕЛЬСТВО')?></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Yandex.Metrika counter -->
    <script type="text/javascript">
        (function (d, w, c) {
            (w[c] = w[c] || []).push(function() {
                try {
                    w.yaCounter43139219 = new Ya.Metrika({
                        id:43139219,
                        clickmap:true,
                        trackLinks:true,
                        accurateTrackBounce:true,
                        webvisor:true
                    });
                } catch(e) { }
            });

            var n = d.getElementsByTagName("script")[0],
                s = d.createElement("script"),
                f = function () { n.parentNode.insertBefore(s, n); };
            s.type = "text/javascript";
            s.async = true;
            s.src = "https://mc.yandex.ru/metrika/watch.js";

            if (w.opera == "[object Opera]") {
                d.addEventListener("DOMContentLoaded", f, false);
            } else { f(); }
        })(document, window, "yandex_metrika_callbacks");
    </script>
    <noscript><div><img src="https://mc.yandex.ru/watch/43139219" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
    <!-- /Yandex.Metrika counter -->
</div>

<div class="mobile-block">
    <div class="mobile-block-inside">
        <div class="mobile-btn cross"></div>
        <div class="mobile-menu">
            <div class="mobile-menu-title">
                <span><?=Yii::t('app','Меню')?></span>
            </div>
            <ul class="nav nav-pills">
                <li class="<?= (isset($this->params['main']) ? $this->params['main'] : '')?>"><a href="/mobile/<?=Lang::getCurrent()->url?>"><?=Yii::t('app','Словарь')?></a></li>
                <li class="<?= (isset($this->params['autho']) ? $this->params['autho'] : '')?>"><a href="<?=\yii\helpers\Url::to('/'.Lang::getCurrent()->url.'/dictionary/default/author/')?>"><?=Yii::t('app','Об авторе')?></a></li>
                <li class="<?= (isset($this->params['about']) ? $this->params['about'] : '')?>"><a href="<?=\yii\helpers\Url::to('/'.Lang::getCurrent()->url.'/dictionary/default/about/')?>"><?=Yii::t('app','О проекте')?></a></li>
            </ul>
        </div>
        <div class="mobile-lang">
            <?=\app\widgets\Language::widget()?>
        </div>
    </div>
    <div class="mobile-btn bg"></div>
</div>


<?php $this->endBody() ?>

</body>
</html>
<?php $this->endPage() ?>
