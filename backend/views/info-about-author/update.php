<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\backend\models\InfoAboutAuthor */

$this->title = 'Update Info About Author: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Info About Authors', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="info-about-author-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
