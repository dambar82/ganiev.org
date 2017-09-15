<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Seo */

$this->title = 'Добавить мета тег';
$this->params['breadcrumbs'][] = ['label' => 'Мета теги', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="seo-create">

    <?= $this->render('_form', [
        'model' => $model,
        'model_eav' => $model_eav
    ]) ?>

</div>
