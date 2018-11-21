<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;

\app\modules\project\assets\ProjectAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <div class="container-fluid">
        <div class="view--card">
            <div class="view--content">
                <div class="view--row">
                    <div class="card--letter">
                        <span>a</span>
                    </div>
                    <div class="card--img">
                        <img src="/img/main_bg.jpg" alt="" class="img-responsive">
                    </div>
                    <div class="card--word">
                        <span>аю</span>
                    </div>
                    <a href="javascript:;" class="card--sound">Озвучить</a>
                </div>
            </div>
        </div>
    </div>
        <!-- <?= $content ?> -->
</div>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
