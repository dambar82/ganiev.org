<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\backend\models\Video */

$this->title = 'Add Video';
$this->params['breadcrumbs'][] = ['label' => 'Video', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="videos-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
