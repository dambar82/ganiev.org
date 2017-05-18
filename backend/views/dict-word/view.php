<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use kartik\form\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\backend\models\DictWord */

$this->title = $model->word;
$this->params['breadcrumbs'][] = ['label' => 'Словарь', 'url' => ['/backend/dict-word']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="dict-word-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Редактировать', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <a class="btn btn-info add_meaning" href="javascript://" data-id="<?=count($meanings)?>"> Добавить значение</a>
        <?= Html::a('Удалить', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Вы действительно хотите удалить слово?',
                'method' => 'post',
            ],
        ]) ?>

        <?= Html::a('Добавить ссылку', ['create-link', 'id' => $model->id], ['class' => 'btn btn-info']) ?>
    </p>
    <p>
        <?= Html::a('Только технически отредактированные', ['/backend/dict-word/?DictWordSearch%5Bword%5D=&DictWordSearch%5Bedit_status%5D=1&DictWordSearch%5Bstatus%5D=&DictWordSearch%5Bfull_status%5D=&DictWordSearch%5Baudio_status%5D='], ['class' => 'btn btn-default']) ?>

        <?= Html::a('На техническое редактирование А-Я', ['/backend/dict-word/index?DictWordSearch%5Bword%5D=&DictWordSearch%5Bedit_status%5D=0&DictWordSearch%5Bstatus%5D=&DictWordSearch%5Bfull_status%5D=&DictWordSearch%5Baudio_status%5D=&sort=word'], ['class' => 'btn btn-default']) ?>

        <?= Html::a('На техническое редактирование Я-А', ['/backend/dict-word/index?DictWordSearch%5Bword%5D=&DictWordSearch%5Bedit_status%5D=0&DictWordSearch%5Bstatus%5D=&DictWordSearch%5Bfull_status%5D=&DictWordSearch%5Baudio_status%5D=&sort=-word'], ['class' => 'btn btn-default']) ?>

    </p>

    <div id="addmeanings" class="addmeanings collapse">
        <?php $form = ActiveForm::begin(); ?>
            <div class="meanings">

            </div>
        <div class="form-group">
            <?= Html::submitButton($model->isNewRecord ? 'Сохранить' : 'Сохранить', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        </div>

        <?php ActiveForm::end(); ?>
    </div>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'word',
            'accent',
            'italic',
            'ending',
            'status',
            'audio_status'
        ],
    ]) ?>

    <?php foreach ($meanings as $mean) :?>
        <h4> Значения: </h4>
    <?= DetailView::widget([
        'model' => $mean,
        'attributes' => [
            'italic',
            'russian_description',
            'description',
            'audio_id'
        ],
    ]) ?>
    <?php endforeach;?>

    <?php foreach ($examples as $example) :?>
        <h4> Примеры: </h4>
        <?= DetailView::widget([
            'model' => $example,
            'attributes' => [
                'rus_value',
                'tat_value'
            ],
        ]) ?>
    <?php endforeach;?>



</div>
