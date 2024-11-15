<?php
/* @var $this yii\web\View */
use app\models\Lang;

$this->params['about'] = 'active';
$langs = Lang::getCurrent();
?>

<div class="site-about basic-page">
    <h2 class="tab-title"><?=Yii::t('app','О проекте')?></h2>
    <div class="main-content">
        <div class="main-text">
            <?= ($langs->id == 2 ? $model->content : $model->content_tat) ?>
        </div>
    </div>
</div>
