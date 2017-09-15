<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Seo */
/* @var $model_eav array */

$this->title = 'Редактировать';
$this->params['breadcrumbs'][] = ['label' => 'Мета', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Обновление';
?>
<div class="seo-update">

    <?= $this->render('_form', [
        'model' => $model,
        'model_eav' => $model_eav
    ]) ?>

</div>
