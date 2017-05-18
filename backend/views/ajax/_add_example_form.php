<?php
use yii\helpers\ArrayHelper;
use app\backend\models\DictMeaning;

$meaning_array = ArrayHelper::map(DictMeaning::find()->where(['word_id' => $word_id])->all(),'id','description');
?>
<div class="bs-callout bs-callout-warning clearfix">
    <h4>Пример №<?=$seq_index+1?></h4>

    <div class="form-group field-dictexamples-0-type">
        <label class="control-label" for="dictexamples-<?=$seq_index?>-type">Type</label>

        <select id="dictexamples-<?=$seq_index?>-type" class="form-control" name="DictExamples[<?=$seq_index?>][type]">
            <option value="0">Обычный пример</option>
            <option value="1">Фразеологизм</option>
        </select>

        <div class="help-block"></div>

    </div>

    <div class="form-group field-dictexamples-<?=$seq_index?>-meaning_id required">
        <label class="control-label" for="dictexamples-<?=$seq_index?>-meaning_id">Значение</label>

        <select id="dictexamples-<?=$seq_index?>-meaning_id" class="form-control" name="DictExamples[<?=$seq_index?>][meaning_id]">
            <?php foreach ($meaning_array as $key => $meaning) : ?>
                <option value="<?=$key?>"><?=$meaning?></option>
            <?php endforeach;?>
        </select>

        <div class="help-block"></div>

    </div>
    <div class="col-xs-5">
        <div class="form-group field-dictexamples-<?=$seq_index?>-rus_value">
            <label class="control-label" for="dictexamples-<?=$seq_index?>-rus_value">На русском</label>

            <input type="text" id="dictexamples-<?=$seq_index?>-rus_value" class="form-control" name="DictExamples[<?=$seq_index?>][rus_value]" maxlength="255">

            <div class="help-block"></div>

        </div>
    </div>
    <div class="col-xs-2 text-center"> <i class="glyphicon glyphicon-transfer style-transfer btn-lg"></i> </div>
    <div class="col-xs-5">
        <div class="form-group field-dictexamples-<?=$seq_index?>-tat_value required">
            <label class="control-label" for="dictexamples-<?=$seq_index?>-tat_value">На татарском</label>

            <input type="text" id="dictexamples-<?=$seq_index?>-tat_value" class="form-control" name="DictExamples[<?=$seq_index?>][tat_value]" maxlength="255">

            <div class="help-block"></div>

        </div>
    </div>
</div>