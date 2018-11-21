<?php

/* @var $model \app\backend\models\Alphabet */

?>

<div class="view--card">
    <div class="view--content">
        <div class="view--row">
            <div class="card--letter">
                <span><?= $model->uppercase ?></span>
            </div>
            <div class="card--img">
                <img src="<?= $model->word_image ?>" alt="" class="img-responsive">
            </div>
            <div class="card--word">
                <span><?= $model->word ?></span>
            </div>
            <a href="javascript:;" class="card--sound">Озвучить</a>
        </div>
    </div>
</div>

<?php
$audioSrc = [];

if (!empty($model->letter_audio)) {
    array_push($audioSrc, $model->letter_audio);
}
if (!empty($model->word_audio)) {
    array_push($audioSrc, $model->word_audio);
}

$audioSrc = \yii\helpers\Json::encode($audioSrc);

$script = <<< JS
    var audioSrc = $audioSrc;
JS;
$this->registerJs($script, yii\web\View::POS_END);
?>