<?php

use yii\helpers\Html;
use kartik\form\ActiveForm;
use kartik\switchinput\SwitchInput;
use yii\helpers\ArrayHelper;
use app\backend\models\DictMeaning;
use kartik\file\FileInput;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model app\backend\models\DictWord */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="dict-word-form">

    <?php $form = ActiveForm::begin([
        'options'=>['enctype'=>'multipart/form-data']
    ]); ?>

    <ul class="nav nav-tabs">
        <li class="active"><a data-toggle="tab" href="#panel1">Слово</a></li>
        <li><a data-toggle="tab" href="#panel2">Значения</a></li>
        <li><a data-toggle="tab" href="#panel3">Примеры</a></li>
    </ul>

    <div class="tab-content">
        <div id="panel1" class="tab-pane fade in active">
            <?= $form->field($model, 'status')->widget(SwitchInput::classname(), [
                'pluginOptions'=>[
                    'handleWidth'=>60,
                    'onText'=>'Да',
                    'offText'=>'Нет',
                    'onColor' => 'success',
                    'offColor' => 'warning',
                ]
            ]); ?>

            <?= $form->field($model, 'edit_status')->widget(SwitchInput::classname(), [
                'pluginOptions'=>[
                    'handleWidth'=>60,
                    'onText'=>'Да',
                    'offText'=>'Нет',
                    'onColor' => 'success',
                    'offColor' => 'warning',
                ]
            ]); ?>

            <?= $form->field($model, 'word')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'description')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'accent')->textInput() ?>

            <?= $form->field($model, 'italic')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'ending')->textInput(['maxlength' => true]) ?>
        </div>

        <div id="panel2" class="tab-pane fade">
            <div class="meanings">
                <!---<a class="btn btn-danger add_meaning" href="javascript://" data-id="<?//=count($meaning)?>"> Добавить значение</a>-->
                <?php foreach ($meaning as $key => $item) :?>
                    <div class="bs-callout bs-callout-info">
                        <h4>Значение №<?=$key+1?></h4>

                        <?php
                        if ($item) {$id = $item->id;} else {$id = '';}

                        echo $form->field($item, "[$key]description",[
                            'addon' => [
                                'prepend' => [
                                    'content' => '<i class="glyphicon glyphicon-remove delete-meaning" data-id="'. $id .'"></i>'
                                ]
                            ]
                        ]);

                        ?>

                        <?= $form->field($item, "[$key]italic")->textInput(['maxlength' => true]) ?>

                        <?= $form->field($item, "[$key]russian_description")->textInput(['maxlength' => true]) ?>

                        <?= $form->field($item, "[$key]audio_id")->widget(FileInput::classname(), [
                            'options' => [
                                'accept' => 'audio/*',
                                'multiple' => false
                            ],
                            'pluginOptions' => [
                                'uploadUrl' => Url::to(['/files/audio/upload']),
                                'previewFileType' => 'audio',
                                'initialPreview'=>[
                                    ($item->audio_id ? '<audio src="'.\Yii::getAlias('@web/files/audio/').$item->audio_id.'" controls>' : NULL),
                                ],
                                'overwriteInitial'=>true,
                                'initialPreviewConfig' => [
                                    [
                                        'caption' =>  ($item->audio_id ? \Yii::getAlias('@web/files/audio/').$item->audio_id : NULL)
                                    ]
                                ],
                                'initialPreviewAsData'=>false,
                                'initialPreviewFileType'=> 'audio',
                            ],
                            'pluginEvents' => [
                                'filebatchselected' => "function(event, files) {
                                    $(this).fileinput('upload');
                                }",
                                'fileuploaded' => "function(event, files, extra) {
                                    $('body').find('input[name =\"DictMeaning[$key][audio_id]\"]:first').val(files.response);
                                }",
                            ]
                        ]);?>

                    </div>
                <?php endforeach;?>
            </div>
        </div>

        <div id="panel3" class="tab-pane fade">
            <div class="examples">
                <a class="btn btn-danger add_example" href="javascript://" data-id="<?=count($examples)?>" data-word="<?=$model->id?>"> Добавить пример</a>
                <?php
                    $meaning_array = ArrayHelper::map(DictMeaning::find()->where(['word_id' => $model->id])->all(),'id','description');
                ?>

                <?php foreach ($examples as $key => $item) :?>
                    <div class="bs-callout bs-callout-warning">
                        <h4>Пример №<?=$key+1?></h4>

                        <?= $form->field($item, "[$key]type")->dropDownList([
                            0 => 'Обычный пример',
                            1 => 'Фразеологизм',
                        ]) ?>

                        <?= $form->field($item, "[$key]meaning_id")->dropDownList($meaning_array) ?>

                        <?= $form->field($item, "[$key]rus_value", [
                            'template' => "<div class='col-xs-5'>{label}\n\n{input}\n{hint}\n{error}</div>"
                        ])->textInput(['maxlength' => true]) ?>

                        <div class="col-xs-2 text-center"> <i class="glyphicon glyphicon-transfer style-transfer btn-lg"></i> </div>

                        <?= $form->field($item, "[$key]tat_value",[
                            'template' => "<div class='col-xs-5'>{label}\n\n{input}\n{hint}\n{error}</div>"
                        ])->textInput(['maxlength' => true]) ?>

                        <div class="clearfix"></div>
                    </div>
                <?php endforeach;?>
            </div>
        </div>

    </div>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Сохранить' : 'Сохранить', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<div id="deleteBox" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title">Удалить значение слова?</h4>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Закрыть</button>
                <button type="button" class="btn btn-danger delete-meaning-modal" data-id="">Удалить</button>
            </div>
        </div>
    </div>
</div>