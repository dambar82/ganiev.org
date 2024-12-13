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
    <meta name="yandex-verification" content="ecc5c30412a31f6b" />
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>
<?php
$currentController = Yii::$app->controller->id;
$currentAction = Yii::$app->controller->action->id;
?>
<div class="fixed-menu">
    <ul>
        <li><a href="/" class="<?= $currentController == 'default' && $currentAction == 'index' ? 'fixed-menu_active' : '' ?>">Словарь</a></li>
        <li><a href="/author" class="<?= $currentController == 'default' && $currentAction == 'author' ? 'fixed-menu_active' : '' ?>">Об Авторе</a></li>
        <li><a href="/about" class="<?= $currentController == 'default' && $currentAction == 'about' ? 'fixed-menu_active' : '' ?>">О проекте</a></li>
    </ul>
</div>

<div class="wrap">
    <div class='header container-fluid'>
        <div class='header_firstRow'>
            <a href="/">
                <img src="/img/logoTat.png" alt="">
            </a>
            <div id='search_header'>
            <h3>
                <?php echo Yii::t('app', 'ОЗВУЧЕННЫЙ')?>
            </h3>
            <h1>
                <?php echo Yii::t('app', 'словарь')?>
            </h1>
            <h1>
                <?php echo Yii::t('app', 'автор')?>
            </h1>
        </div>
            <div class="head-lang">
                <?=\app\widgets\Language::widget()?>
            </div>
        </div>
    </div>
    <div class='search_header'>
            <h3>
                ОЗВУЧЕННЫЙ
            </h3>
            <h1>
            Русско-Татарский словарь
            </h1>
            <h1>
            Ганиева Ф.А
            </h1>
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
    <div class="footer_content container-fluid">
    Поддержка и разработка сайта – «<a href='https://www.tatarmultfilm.ru/'>Татармультфильм</a>» [2024].<br> Все права защищены. 
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


<?php $this->endBody() ?>

</body>
</html>
<?php $this->endPage() ?>
