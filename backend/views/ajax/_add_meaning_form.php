<div class="bs-callout bs-callout-info">
    <h4>Значение №<?=$seq_index+1?></h4>

    <div class="form-group field-dictmeaning-<?=$seq_index?>-description required">
        <label class="control-label" for="dictmeaning-<?=$seq_index?>-description">Перевод (на татарском)</label>

        <input type="text" id="dictmeaning-<?=$seq_index?>-description" class="form-control" name="DictMeaning[<?=$seq_index?>][description]"></div>

        <div class="help-block"></div>

    <div class="form-group field-dictmeaning-<?=$seq_index?>-italic">
        <label class="control-label" for="dictmeaning-<?=$seq_index?>-italic">Курсив (сокращения)</label>

        <input type="text" id="dictmeaning-<?=$seq_index?>-italic" class="form-control" name="DictMeaning[<?=$seq_index?>][italic]">

        <div class="help-block"></div>

    </div>
    <div class="form-group field-dictmeaning-<?=$seq_index?>-russian_description">
        <label class="control-label" for="dictmeaning-<?=$seq_index?>-russian_description">Описание (на русском)</label>

        <input type="text" id="dictmeaning-<?=$seq_index?>-russian_description" class="form-control" name="DictMeaning[<?=$seq_index?>][russian_description]">

        <div class="help-block"></div>

    </div>
</div>