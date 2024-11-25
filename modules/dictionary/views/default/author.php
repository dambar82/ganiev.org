<?php
/* @var $this yii\web\View */
use app\models\Lang;

$this->params['autho'] = 'active';

$langs = Lang::getCurrent();
?>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fancyapps/ui/dist/fancybox.css" />
<script src="https://cdn.jsdelivr.net/npm/@fancyapps/ui/dist/fancybox.umd.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', () => {
        Fancybox.bind("[data-fancybox]", {
            // Опциональные настройки
            Toolbar: {
                display: [
                    { id: "prev", position: "left" },
                    { id: "counter", position: "center" },
                    { id: "next", position: "right" },
                    "close",
                ],
            },
            Thumbs: {
                autoStart: true, // Включить превью
            },
        });
    });

document.addEventListener("DOMContentLoaded", () => {
    const slider = document.querySelector(".slider");
    const slides = document.querySelectorAll(".views-row");

    let activeIndex = 0;

    const updateSlider = (index) => {
        activeIndex = index;

        slides.forEach((slide, i) => {
            // Сбрасываем классы
            slide.classList.remove("active", "next", "previous");

            if (i === index) {
                slide.classList.add("active");

                // Добавляем "готовность" для `::before` после анимации
            } else if (i === index + 1) {
                slide.classList.add("next");
            } else if (i === index - 1) {
                slide.classList.add("previous");
            }
        });

        const offset = -slides[index].offsetLeft + 5;
        slider.style.transition = "transform 0.3s ease";
        slider.style.transform = `translateX(${offset}px)`;
    };

    slides.forEach((slide, index) => {
        slide.addEventListener("click", () => {
            updateSlider(index);
        });
    });

    updateSlider(activeIndex); // Инициализация слайдера
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
  <li><a href="#author-fourth" data-toggle="tab"><?=Yii::t('app','Фото')?></a></li>
  <li><a href="#author-fifth" data-toggle="tab"><?=Yii::t('app','Видео')?></a></li>
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
    <div class="tab-pane" id="author-fourth">
        <div class='tabName'><?=Yii::t('app','Фото')?></div>
        <div class="block-author">
            <div class="main-content">
                <div class="main-text">
                    <?php if (is_array($photos) && count($photos) > 0): ?>
                        <?php foreach ($photos as $photo): ?>
                            <img src="http://ganiev.org/source/photos/<?= $photo['photo'] ?>" alt="Фото">
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
    <div class="tab-pane" id="author-fifth">
        <div class='tabName'><?=Yii::t('app','Видео')?></div>
        <div class="block-author">
            <div class="main-content">
                <div class="main-text">
                    <?php if (is_array($videos) && count($videos) > 0): ?>
                        <div class="video-container">
                            <?php foreach ($videos as $video): ?>
                                <video controls>
                                    <source src="http://ganiev.org/source/videos/<?= htmlspecialchars($video['video'], ENT_QUOTES) ?>" type="video/mp4">
                                    Ваш браузер не поддерживает видео тег.
                                </video>
                            <?php endforeach; ?>
                        </div>
                    <?php else: ?>
                        <p>Видео отсутствуют.</p>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>