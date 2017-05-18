<?php
    $disabled = '';
    if (!empty($field)) {
        $disabled = 'disabled';
    }
?>

<div class="translate-form">
    <form class="translate-form">
        <div class="form-group">
            <label for="field">Ключ:</label>
            <input type="text" class="form-control" id="word" name="word" placeholder="Значение ключа" value="<?=$field?>" <?=$disabled?>>
            <input type="hidden" class="form-control" id="action" name="action">
        </div>

        <?php foreach ($languages as $language) : ?>
            <div class="form-group">
                <label for="<?=$language->id?>"><?=$language->name?></label>
                <textarea name="<?=$language->id?>" rows="4" class="form-control" id="<?=$language->id?>"> <?=$translate[$language->id]?></textarea>
            </div>
        <?php endforeach;?>
    </form>
</div>
