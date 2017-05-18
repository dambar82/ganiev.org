<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\backend\models\DictWordSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Словарь';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="dict-word-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Добавить слово', ['create'], ['class' => 'btn btn-success']) ?>

        <?= Html::a('Только технически отредактированные', ['/backend/dict-word/?DictWordSearch%5Bword%5D=&DictWordSearch%5Bedit_status%5D=1&DictWordSearch%5Bstatus%5D=&DictWordSearch%5Bfull_status%5D=&DictWordSearch%5Baudio_status%5D='], ['class' => 'btn btn-default']) ?>

        <?= Html::a('На техническое редактирование А-Я', ['/backend/dict-word/index?DictWordSearch%5Bword%5D=&DictWordSearch%5Bedit_status%5D=0&DictWordSearch%5Bstatus%5D=&DictWordSearch%5Bfull_status%5D=&DictWordSearch%5Baudio_status%5D=&sort=word'], ['class' => 'btn btn-default']) ?>

        <?= Html::a('На техническое редактирование Я-А', ['/backend/dict-word/index?DictWordSearch%5Bword%5D=&DictWordSearch%5Bedit_status%5D=0&DictWordSearch%5Bstatus%5D=&DictWordSearch%5Bfull_status%5D=&DictWordSearch%5Baudio_status%5D=&sort=-word'], ['class' => 'btn btn-default']) ?>
    </p>

    <p>
        <?= Html::a('А', ['/backend?DictWordSearch%5Bword%5D=а&DictWordSearch%5Bedit_status%5D=0'], ['class' => 'btn btn-default']) ?>
        <?= Html::a('Б', ['/backend?DictWordSearch%5Bword%5D=б&DictWordSearch%5Bedit_status%5D=0'], ['class' => 'btn btn-default']) ?>
        <?= Html::a('В', ['/backend?DictWordSearch%5Bword%5D=в&DictWordSearch%5Bedit_status%5D=0'], ['class' => 'btn btn-default']) ?>
        <?= Html::a('Г', ['/backend?DictWordSearch%5Bword%5D=г&DictWordSearch%5Bedit_status%5D=0'], ['class' => 'btn btn-default']) ?>
        <?= Html::a('Д', ['/backend?DictWordSearch%5Bword%5D=д&DictWordSearch%5Bedit_status%5D=0'], ['class' => 'btn btn-default']) ?>
        <?= Html::a('Е', ['/backend?DictWordSearch%5Bword%5D=е&DictWordSearch%5Bedit_status%5D=0'], ['class' => 'btn btn-default']) ?>
        <?= Html::a('Ж', ['/backend?DictWordSearch%5Bword%5D=ж&DictWordSearch%5Bedit_status%5D=0'], ['class' => 'btn btn-default']) ?>
        <?= Html::a('З', ['/backend?DictWordSearch%5Bword%5D=з&DictWordSearch%5Bedit_status%5D=0'], ['class' => 'btn btn-default']) ?>
        <?= Html::a('И', ['/backend?DictWordSearch%5Bword%5D=и&DictWordSearch%5Bedit_status%5D=0'], ['class' => 'btn btn-default']) ?>
        <?= Html::a('Й', ['/backend?DictWordSearch%5Bword%5D=й&DictWordSearch%5Bedit_status%5D=0'], ['class' => 'btn btn-default']) ?>
        <?= Html::a('К', ['/backend?DictWordSearch%5Bword%5D=к&DictWordSearch%5Bedit_status%5D=0'], ['class' => 'btn btn-default']) ?>
        <?= Html::a('Л', ['/backend?DictWordSearch%5Bword%5D=л&DictWordSearch%5Bedit_status%5D=0'], ['class' => 'btn btn-default']) ?>
        <?= Html::a('М', ['/backend?DictWordSearch%5Bword%5D=м&DictWordSearch%5Bedit_status%5D=0'], ['class' => 'btn btn-default']) ?>
        <?= Html::a('Н', ['/backend?DictWordSearch%5Bword%5D=н&DictWordSearch%5Bedit_status%5D=0'], ['class' => 'btn btn-default']) ?>
        <?= Html::a('О', ['/backend?DictWordSearch%5Bword%5D=о&DictWordSearch%5Bedit_status%5D=0'], ['class' => 'btn btn-default']) ?>
        <?= Html::a('П', ['/backend?DictWordSearch%5Bword%5D=п&DictWordSearch%5Bedit_status%5D=0'], ['class' => 'btn btn-default']) ?>
        <?= Html::a('Р', ['/backend?DictWordSearch%5Bword%5D=р&DictWordSearch%5Bedit_status%5D=0'], ['class' => 'btn btn-default']) ?>
        <?= Html::a('С', ['/backend?DictWordSearch%5Bword%5D=с&DictWordSearch%5Bedit_status%5D=0'], ['class' => 'btn btn-default']) ?>
        <?= Html::a('Т', ['/backend?DictWordSearch%5Bword%5D=т&DictWordSearch%5Bedit_status%5D=0'], ['class' => 'btn btn-default']) ?>
        <?= Html::a('У', ['/backend?DictWordSearch%5Bword%5D=у&DictWordSearch%5Bedit_status%5D=0'], ['class' => 'btn btn-default']) ?>
        <?= Html::a('Ф', ['/backend?DictWordSearch%5Bword%5D=ф&DictWordSearch%5Bedit_status%5D=0'], ['class' => 'btn btn-default']) ?>
        <?= Html::a('Х', ['/backend?DictWordSearch%5Bword%5D=х&DictWordSearch%5Bedit_status%5D=0'], ['class' => 'btn btn-default']) ?>
        <?= Html::a('Ц', ['/backend?DictWordSearch%5Bword%5D=ц&DictWordSearch%5Bedit_status%5D=0'], ['class' => 'btn btn-default']) ?>
        <?= Html::a('Ч', ['/backend?DictWordSearch%5Bword%5D=ч&DictWordSearch%5Bedit_status%5D=0'], ['class' => 'btn btn-default']) ?>
        <?= Html::a('Ш', ['/backend?DictWordSearch%5Bword%5D=ш&DictWordSearch%5Bedit_status%5D=0'], ['class' => 'btn btn-default']) ?>
        <?= Html::a('Щ', ['/backend?DictWordSearch%5Bword%5D=щ&DictWordSearch%5Bedit_status%5D=0'], ['class' => 'btn btn-default']) ?>
        <?= Html::a('Э', ['/backend?DictWordSearch%5Bword%5D=э&DictWordSearch%5Bedit_status%5D=0'], ['class' => 'btn btn-default']) ?>
        <?= Html::a('Ю', ['/backend?DictWordSearch%5Bword%5D=ю&DictWordSearch%5Bedit_status%5D=0'], ['class' => 'btn btn-default']) ?>
        <?= Html::a('Я', ['/backend?DictWordSearch%5Bword%5D=я&DictWordSearch%5Bedit_status%5D=0'], ['class' => 'btn btn-default']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'word',

            [
                'attribute'=>'edit_status',
                'filter'=>array("0"=>"Не проверен","1"=>"Проверен","2"=>"Полностью готов"),
                'content'=>function($data){
                    if ($data->edit_status == 0) {
                        $label_class = 'label-info';
                        $message = 'Не проверен';
                    }
                    if ($data->edit_status == 1) {
                        $label_class = 'label-success';
                        $message = 'Проверен';
                    }
                    if ($data->edit_status == 2) {
                        $label_class = 'label-success';
                        $message = 'Проверен';
                    }
                    return "<span class='label ".$label_class."'>".$message."</span>";
                }
            ],

            [
                'attribute'=>'status',
                'filter'=>array("0"=>"Не проверено","1"=>"Проверено"),
                'content'=>function($data){
                    if ($data->status == 1) {
                        $label_class = 'label-success';
                        $message = 'Проверен';
                    } else {
                        $label_class = 'label-info';
                        $message = 'Не проверен';
                    }
                    return "<span class='label ".$label_class."'>".$message."</span>";
                }
            ],

            [
                'attribute'=>'audio_status',
                'filter'=>array("0"=>"Нет файлов","1"=>"Не все файлы","2"=>"Все подключено"),
                'content'=>function($data){
                    switch ($data->audio_status) {
                        case 0:
                            $label_class = 'label-warning'; $message = 'нет'; break;
                        case 1:
                            $label_class = 'label-danger'; $message = 'не все'; break;
                        case 2:
                            $label_class = 'label-success'; $message = 'есть'; break;
                    }
                    return "<span class='label ".$label_class."'>".$message."</span>";
                }
            ],

            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{view} {update} {delete} {link}',
                'buttons' => [
                    'link' => function ($url,$model,$key) {
                        $url = '/backend/dict-word/create-link?id='.$model->id;
                        return Html::a(
                            '<i class="glyphicon glyphicon-link"></i>',
                            $url,['class' => 'btn btn-info']);
                    },
                ],
            ],
        ],
    ]); ?>
</div>
