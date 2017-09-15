<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\backend\models\DictAbbr */

$this->title = 'Create Dict Abbr';
$this->params['breadcrumbs'][] = ['label' => 'Dict Abbrs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="dict-abbr-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
