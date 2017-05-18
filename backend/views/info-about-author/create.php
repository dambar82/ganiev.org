<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\backend\models\InfoAboutAuthor */

$this->title = 'Create Info About Author';
$this->params['breadcrumbs'][] = ['label' => 'Info About Authors', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="info-about-author-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
