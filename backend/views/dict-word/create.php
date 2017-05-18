<?php

use yii\helpers\Html;

$this->title = 'Добавить слово';
$this->params['breadcrumbs'][] = ['label' => 'Словарь', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="dict-word-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'meaning' => $meaning,
        'examples' => $examples
    ]) ?>

</div>
