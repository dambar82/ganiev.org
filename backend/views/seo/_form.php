<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\Pages;
use yii\helpers\ArrayHelper;
use app\models\Lang;

/* @var $this yii\web\View */
/* @var $model app\models\Seo */
/* @var $model_eav array */
/* @var $form yii\widgets\ActiveForm */

$pages = ArrayHelper::map(Pages::find()->all(),'id','page');
$language = ArrayHelper::map(Lang::find()->all(),'id','url');
?>

<div class="seo-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'page')->dropDownList($pages) ?>

    <div class="row">
        <?php foreach ($model_eav as $key=>$eav) : ?>
            <div class="col-sm-4">
                <?= $form->field($eav, "[$key]title")->textInput()->label('Title - '.$language[$key]) ?>

                <?= $form->field($eav, "[$key]description")->textarea()->label('Description - '.$language[$key]) ?>

                <?= $form->field($eav, "[$key]keywords")->textInput()->label('Keywords - '.$language[$key]) ?>

            </div>
        <?php endforeach; ?>
    </div>

    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
