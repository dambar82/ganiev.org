<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\backend\models\DictWord */

$this->title = $model->word;
$this->params['breadcrumbs'][] = ['label' => 'Словарь', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->word, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Редактирование';
?>
<div class="dict-word-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'meaning' => $meaning,
        'examples' => $examples
    ]) ?>

</div>
