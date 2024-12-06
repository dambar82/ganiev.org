<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\backend\models\Photo */

$this->title = 'Add Photo';
$this->params['breadcrumbs'][] = ['label' => 'Photo', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="photos-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
