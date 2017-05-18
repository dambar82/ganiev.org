<?php
/* @var $this yii\web\View */
use app\models\Lang;

$this->params['autho'] = 'active';

$langs = Lang::getCurrent();
?>
<ul class="nav nav-tabs">
  <li class="active"><a href="#author-first" data-toggle="tab"><?=Yii::t('app','Об авторе')?></a></li>
  <li><a href="#author-second" data-toggle="tab"><?=Yii::t('app','Коллеги о Ф.А. Ганиеве')?></a></li>
  <li><a href="#author-third" data-toggle="tab"><?=Yii::t('app','Научное наследие')?></a></li>
</ul>
<div class="tab-content">
    <div class="tab-pane active" id="author-first">
        <h2 class="tab-title"><?=Yii::t('app','Ганиев Фуат Ашрафович')?></h2>
        <div class="block-author">
            <div class="main-content">
                <?php if ($model->image_id) : ?>
                    <div class="author-content">
                        <img class="img-thumbnail img-responsive" src="<?=Yii::getAlias('@web/files/').$model->image_id ?>">
                    </div>
                <?php endif;?>
                <div class="main-text">
                    <?= ($langs->id == 2 ? $model->content : $model->content_tat) ?>
                </div>
            </div>
        </div>
    </div>
    <div class="tab-pane" id="author-second">
      <h2 class="tab-title"><?=Yii::t('app','Коллеги о Ф.А. Ганиеве')?></h2>
      <div class="views-about-author">
          <?php if ($comments): ?>
          <div class="views-content">
              <?php foreach ($comments as $key => $value) : ?>
                  <?php $class = ($key%2 ==0 ? 'views-row-odd' : 'views-row-even'); ?>
                  <div class="views-row <?=$class?>">
                      <div class="about-author-text">
                          <div class="field-content">
                              <?= ($langs->id == 2 ? $value->content : $value->content_tat) ?>
                          </div>
                      </div>
                      <div class="about-author-title">
                          <span class="filed-content"><?= ($langs->id == 2 ? $value->author : $value->author_tat) ?></span>
                      </div>
                  </div>
              <?php endforeach;?>
          </div>
          <?php endif;?>
      </div>
    </div>
    <div class="tab-pane" id="author-third">
        <h2 class="tab-title"><?=Yii::t('app','Научное наследие')?></h2>
        <div class="block-author">
            <div class="main-content">
                <div class="main-text">
                    <?= ($langs->id == 2 ? $nasledie->content : $nasledie->content_tat) ?>
                </div>
            </div>
        </div>
    </div>
</div>
