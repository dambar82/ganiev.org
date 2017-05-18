<?php

use yii\helpers\Html;

if ($model->id ==1) {
    $this->title = 'О авторе';
} else {
    $this->title = 'О проекте';
}

?>
<div class="info-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
