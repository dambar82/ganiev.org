<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\backend\models\Photo */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Photos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="photos-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            [
                'attribute' => 'photo',
                'format' => 'html',
                'value' => function($model) {
                    $imageUrl = Url::to('@web/' . $model->photo);
                    return Html::img($imageUrl, ['alt' => 'Photo', 'style' => 'width:300px; height:auto;']);
                },
            ],
        ],
    ]) ?>

</div>
