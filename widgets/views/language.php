<?php
use app\models\Lang;

/* @var $current \app\models\Lang */
/* @var $langs \app\models\Lang */

$current_lang = Lang::getCurrent();

$other_lang = $langs[0]->id === $current_lang->id ? $langs[1] : $langs[0];

// Определяем сокращенные названия языков
$current_lang_name = ($current_lang->id == 1) ? 'РУС' : 'ТАТ';
$other_lang_name = ($other_lang->id == 1) ? 'РУС' : 'ТАТ';

?>

<div class="container-fluid">
    <div class="row">
        <div class="lang-block pull-right">
            <div class="col-xs-12">
                <button 
                    class="lang-toggle <?= $current_lang->id == 1 ? 'lang-rus' : 'lang-tat' ?>" 
                    data-current-lang="<?= $current_lang->id ?>" 
                    data-lang-url="<?= '/' . $other_lang->url . Yii::$app->getRequest()->getLangUrl() ?>"
                    onclick="toggleLanguage(this)"
                >
                    <span class="lang-text"><?= $current_lang_name ?></span>
                    <span class="toggle-circle"></span>
                </button>
            </div>
        </div>
    </div>
</div>

<script>
    function toggleLanguage(button) {
        const currentLang = button.getAttribute('data-current-lang');
        let langUrl, langText;

        if (currentLang == '1') {
            langUrl = '<?= '/' . $langs[1]->url . Yii::$app->getRequest()->getLangUrl() ?>';
            langText = 'ТАТ';
            button.setAttribute('data-current-lang', '2');
            button.classList.remove('lang-rus');
            button.classList.add('lang-tat');
        } else {
            langUrl = '<?= '/' . $langs[0]->url . Yii::$app->getRequest()->getLangUrl() ?>';
            langText = 'РУС';
            button.setAttribute('data-current-lang', '1');
            button.classList.remove('lang-tat');
            button.classList.add('lang-rus');
        }

        // Обновляем текст языка на кнопке
        button.querySelector('.lang-text').textContent = langText;
        window.location.href = langUrl;
    }
</script>

<style>
    .lang-toggle {
        display: flex;
        align-items: center;
        width: 86px;
        height: 36px;
        background-color: white;
        border: 2px solid #019303;
        border-radius: 50px;
        cursor: pointer;
        position: relative;
        /* padding: 0 4px; */
        transition: 0.3s;
    }
    .lang-text {
        font-size: 18px;
        line-height: 22px;
        color: #019303;
        position: absolute;
        transition: 0.3s;
    }
    .toggle-circle {
        width: 28px;
        height: 28px;
        background-color: #019303;
        border-radius: 50%;
        position: absolute;
        transition: 0.3s;
    }

    /* Позиционирование текста и круга для русского языка */
    .lang-toggle.lang-rus .lang-text {
        left: 11px;
    }
    .lang-toggle.lang-rus .toggle-circle {
        right: 4px;
    }

    /* Позиционирование текста и круга для татарского языка */
    .lang-toggle.lang-tat .lang-text {
        right: 11px;
    }
    .lang-toggle.lang-tat .toggle-circle {
        left: 4px;
    }
</style>
