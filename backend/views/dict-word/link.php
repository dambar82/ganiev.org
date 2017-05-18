<?php

use yii\helpers\Html;
use kartik\form\ActiveForm;
use kartik\select2\Select2;


/* @var $this yii\web\View */
/* @var $model app\backend\models\DictWord */
/* @var $form yii\widgets\ActiveForm */

$data = [];
?>

<div class="dict-word-form">

    <?php $form = ActiveForm::begin([
        'options'=>['enctype'=>'multipart/form-data']
    ]); ?>

    <?= $form->field($model, 'link_word_id')->widget(Select2::classname(), [
        'data' => $data,
        'options' => ['placeholder' => 'Выберите ссылку'],
        'pluginOptions' => [
            'allowClear' => true,
            'ajax' => [
                'url' => '/backend/ajax/load-links',
                'dataType' => 'json',
                'data' => new \yii\web\JsExpression('function(params) { return {q:params.term}; }')
            ],
        ],
    ]);?>


    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>