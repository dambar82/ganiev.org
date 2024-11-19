<?php
/* @var $this yii\web\View */
use app\models\Lang;

$this->params['autho'] = 'active';

$langs = Lang::getCurrent();
?>
<script>
document.addEventListener("DOMContentLoaded", () => {
    const slider = document.querySelector(".slider");
    const slides = Array.from(document.querySelectorAll(".views-row"));
    let activeIndex = 0;

    const updateSlider = (index) => {
        activeIndex = index;

        // Перемещаем все прошедшие элементы в конец
        for (let i = 0; i < activeIndex; i++) {
            const slide = slider.firstElementChild;
            slider.appendChild(slide);
        }

        // Сбрасываем activeIndex и обновляем классы
        activeIndex = 0;
        const updatedSlides = Array.from(slider.children);
        updatedSlides.forEach((slide, i) => {
            slide.classList.remove("active", "next");
            if (i === 0) {
                slide.classList.add("active");
            } else if (i === 1) {
                slide.classList.add("next");
            }
        });

        // Смещаем слайдер на первый элемент
        const offset = -updatedSlides[0].offsetLeft + 5;
        slider.style.transform = `translateX(${offset}px)`;
    };

    // Обработчики кликов
    slides.forEach((slide, index) => {
        slide.addEventListener("click", () => {
            updateSlider(index);
        });
    });

    // Инициализация слайдера
    updateSlider(activeIndex);
});

document.querySelectorAll('.field-content').forEach((content) => {
    const lineHeight = parseFloat(getComputedStyle(content).lineHeight); // Высота строки
    const maxLines = 15;
    const maxHeight = lineHeight * maxLines;

    // Проверка высоты содержимого
    if (content.scrollHeight > maxHeight) {
        const moreButton = document.createElement('div');
        moreButton.className = 'more_button';
        moreButton.textContent = 'Развернуть';
        content.parentNode.appendChild(moreButton);
    }
});

</script>
<ul class="nav nav-tabs">
  <li class="active"><a href="#author-first" data-toggle="tab"><?=Yii::t('app','Биография')?></a></li>
  <li><a href="#author-second" data-toggle="tab"><?=Yii::t('app','Коллеги о Ф.А. Ганиеве')?></a></li>
  <li><a href="#author-third" data-toggle="tab"><?=Yii::t('app','Научное наследие')?></a></li>
</ul>
<div class="tab-content">
    <div class="tab-pane active" id="author-first">
        <div class='tabName'><?=Yii::t('app','Биография')?></div>
        <div class="block-author">
            <div class='title-wrapper'>
                <div class='thin_img' style='min-width: 152px; max-width: 152px; height: 152px'>
                    <img src="/img/muzhik.png" alt="">
               </div>
                <h2 class="tab-title"><?=Yii::t('app','Ганиев Фуат Ашрафович')?></h2>
            </div>
            <div class="main-content">
                <!-- <?php if ($model->image_id) : ?> -->
                    <!-- <div class="author-content">
                        <img class="img-thumbnail img-responsive" src="<?=Yii::getAlias('@web/files/').$model->image_id ?>">
                    </div> -->
                <!-- <?php endif;?> -->
                <div class="main-text">
                    <?= ($langs->id == 2 ? $model->content : $model->content_tat) ?>
                </div>
            </div>
        </div>
    </div>
    <div class="tab-pane" id="author-second">
      <div class='tabName'><?=Yii::t('app','Коллеги о Ф.А. Ганиеве')?></div>
      <div class="views-about-author">
      <?php if ($comments): ?>
        <div class="slider-wrapper">
            <div class="views-content slider">
                <?php foreach ($comments as $key => $value) : ?>
                <div class="views-row" data-index="<?= $key ?>">
                    <div class="about-author-text">
                        <div class="field-content">
                            <?= ($langs->id == 2 ? $value->content : $value->content_tat) ?>
                        </div>
                        <div class="about-author-title">
                            <span class="filed-content"><?= ($langs->id == 2 ? $value->author : $value->author_tat) ?></span>
                        </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>
<?php endif; ?>
      </div>
    </div>
    <div class="tab-pane" id="author-third">
        <div class='tabName'><?=Yii::t('app','Научное наследие')?></div>
        <div class="block-author">
            <div class="main-content">
                <div class="main-text">
                    <?= ($langs->id == 2 ? $nasledie->content : $nasledie->content_tat) ?>
                </div>
            </div>
        </div>
    </div>
</div>