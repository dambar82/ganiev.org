<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\backend\models\Video */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Video', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$videoUrl = 'http://ganiev.org/' . htmlspecialchars($model->video, ENT_QUOTES);
?>
<div class="videos-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= \yii\widgets\DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            // Добавьте сюда все остальные нужные атрибуты, например:
            // 'other_attribute1',
            // 'other_attribute2',
        ],
    ]) ?>



    <div class="video-container">
        <h3><?= $model->video?></h3> <!-- Заголовок для видео -->
            <video controls style="width:300px; height:auto;">
                <source src="<?= $videoUrl ?>" type="video/mp4">
                Ваш браузер не поддерживает видео.
            </video>
    </div>
    <p>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>




</div>
