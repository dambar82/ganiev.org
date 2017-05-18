<?php
use app\modules\translate\assets\TranslateAsset;

TranslateAsset::register($this);

?>

<div class="translate_header clearfix">
    <div class="col-md-3">
        <div class="box box-info">
            <div class="box-header">
                <i class="fa fa-key"></i> <h3 class="box-title">Ключ</h3>
                <div class="pull-right">
                    <a href="javascript://" class="add_translate">
                        <i class="fa fa-plus"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <?php foreach ($languages as $language): ?>
           <div class="col-md-3">
               <div class="box box-info">
                   <div class="box-header">
                       <i class="ion ion-clipboard"></i> <h3 class="box-title"><?=$language->name?></h3>
                   </div>
               </div>
           </div>
    <?php endforeach; ?>
</div>

<div class="translate_body">
    <?php foreach ($mapping as $map_key => $map_item): ?>
        <div class="translate-row">
            <div class="col-md-3">
                <div class="form-group">
                    <a href="javascript://" class="edit_translate" data-id="<?=$map_key?>">
                        <i class="fa fa-pencil"></i>
                    </a>
                    <?=$map_key?>
                </div>
            </div>

            <?php foreach ($languages as $language): ?>
                <div class="col-md-3" data-name="<?=$map_key?>">
                    <div class="form-group" data-name="<?=$language->id?>">
                        <?=$model[$language->id][$map_key]?>
                    </div>
                </div>
            <?php endforeach; ?>

            <div class="clearfix"></div>

        </div>
    <?php endforeach; ?>
</div>

<div id="translate-form" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title">Заголовок модального окна</h4>
            </div>
            <div class="modal-body">
                Содержимое модального окна...
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Закрыть</button>
                <button type="button" class="btn btn-primary save-translate-words">Сохранить изменения</button>
            </div>
        </div>
    </div>
</div>
