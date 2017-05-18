<?php
/* @var $this yii\web\View */
use app\models\Lang;

$this->params['about'] = 'active';
$langs = Lang::getCurrent();
?>

<h1 class="page-title"><?=Yii::t('app','О проекте')?></h1>
<div class="site-about basic-page">
    <div class="main-content">
        <div class="main-text">
            <?= ($langs->id == 2 ? $model->content : $model->content_tat) ?>
        </div>
    </div>
</div>
