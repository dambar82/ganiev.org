<?php
use yii\helpers\Html;
use kartik\typeahead\Typeahead;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use app\backend\models\DictAbbr;
use app\models\Lang;

$this->params['main'] = 'active';

$abbr = ArrayHelper::map(DictAbbr::find()->all(),'abbr','title');

$langs = Lang::getCurrent();
$url = Yii::$app->urlManager->createUrl('/search', array('lang_id'=>Lang::getCurrent()->id));
?>

<script>
    document.addEventListener('DOMContentLoaded', () => {
    const playButtons = document.querySelectorAll('.play-audio');

    playButtons.forEach(button => {
        button.addEventListener('click', () => {
            const audioSrc = button.getAttribute('data-src');
            if (audioSrc) {
                const audio = new Audio(audioSrc);
                audio.play();
            } else {
                console.error('Аудиофайл не найден');
            }
        });
    });
});
</script>    

<div id="canvas">

    <div id="search_block">
        <div class="search_pol">
            <?= Html::beginForm($url, 'post', ['class' => 'search_form']); ?>

            <?= Typeahead::widget([
                'name' => 'search',
                'id' => "tags",
                'value' => isset($word) ? $word : '',
                'options' => ['placeholder' => Yii::t('app','Введите слово')],
                'pluginOptions' => ['highlight'=>true],
                'pluginEvents' => [
                    "typeahead:select" => 'function(ev, resp) { $(".search_form").submit(); }',
                ],
                'dataset' => [
                    [
                        'limit' => 6,
                        'remote' => [
                            'url' => Url::to(['/dictionary/default/autocomplete']) . '?q=%QUERY',
                            'wildcard' => '%QUERY'
                        ]
                    ]
                ]
            ]);?>

            <?= Html::submitButton(Yii::t('app','Перевести'), ['class' => 'search_but', 'name' => 'hash-button']) ?>
            <?= Html::endForm() ?>
        </div>
    </div>

    <div id="search_result">
        <?php
        if (!empty($message)) {
            echo '<div class="alert alert-danger">'.$message.'</div>';
        }

        if (!empty($results)) {
            foreach ($results as $word): ?>
                <div class="search_word">
                    <?php
                    $word_result = $word['word']->word;
                    if ($word['word']->accent > 0) {
                        $word_start = mb_substr($word['word']->word,0,$word['word']->accent-1);
                        $word_center = mb_substr($word['word']->word,$word['word']->accent-1,1);
                        $word_end = mb_substr($word['word']->word,$word['word']->accent,mb_strlen($word['word']->word)-$word['word']->accent);
                        $word_result = $word_start.'<span class="accent">'.$word_center.'</span>'.$word_end;
                    }
                    ?>
                    <div class="words">
                        <div class="word">
                            <?php
                                $memeber = '';
                                if ($word['word']->italic) {
                                    $memeber_explode = explode(' ', trim($word['word']->italic));
                                    foreach ($memeber_explode as $explod) {
                                        if (isset($abbr[$explod])) {
                                            $memeber .= '<span class="abbr" data-toggle="popover" data-content="'.$abbr[$explod].'">' . $explod . '</span> ';
                                        } else {
                                            $memeber = $memeber . ' ' . $explod. ' ';
                                        }
                                    }
                                }
                            ?>
                            <div class='searchingFlex'>
                                <div class="searchingWord">
                                <h1> <?= $word_result .' '.$word['word']->ending?></h1>
                                </div>
                                <div class="member"><?= $memeber ?></div>
                            </div>

                            <?php
                            $mean_all_count = false;
                            if ((count($word['meaning']) + count($word['links'])) > 1) {
                                $mean_all_count = true;
                            }
                            ?>

                            <?php foreach ($word['links'] as $link_count => $link) : ?>
                                <div class="link_word">
                                    <?php
                                    $number = ($mean_all_count) ? ($link_count + 1).'. ' : '';
                                    ?>
                                    <?= $number?>
                                    см.
                                    <?= Html::a($link->value, [Yii::$app->urlManager->createWordUrl(['word' => $link->link_word_id])], [
                                        'data' => [
                                            'method' => 'post',
                                            'id' => $link->link_word_id
                                        ],
                                    ]) ?>
                                </div>
                            <?php endforeach;?>

                            <?php $idioma = ''; ?>

                            <?php foreach ($word['meaning'] as $meaning_count => $meaning): ?>
                                <!-- <div class="hidden audio-src" data-src=""></div> -->
                                <div class="word_description">
                                    <?php
                                    $number = ($mean_all_count) ? ($meaning_count + 1 + count($word['links'])).'. ' : '';
                                    $italic = ($meaning->italic) ? '<div class="member-meaning">'.$meaning->italic.'</div>' : '';
                                    $description = ($meaning->russian_description) ? '<div class="description-meaning">'.$meaning->russian_description.'</div>' : '';
                                    ?>

                                    <?php
                                    $memeber = '';
                                    if (!empty($italic)) {
                                        $memeber_explode = explode(' ', trim($meaning->italic));
                                        foreach ($memeber_explode as $explod) {
                                            if (isset($abbr[$explod])) {
                                                $memeber .= '<span class="abbr" data-toggle="popover" data-content="'.$abbr[$explod].'">' . $explod . '</span> ';
                                            } else {
                                                $memeber =  $memeber . ' ' . $explod. ' ';
                                            }
                                        }
                                        ?>

                                    <span class="member_what">[<?= $memeber ?>]</span>
                                        <?php
                                    }
                                    ?>
                                    <div class='word_flex'>
                                        <?= $meaning->description?>
                                        <?php if (!empty($meaning->audio_id)): ?>
                                            <button 
                                                class="play-audio" 
                                                data-src="<?= Yii::getAlias('@web/files/audio') . '/' . $meaning->audio_id; ?>"
                                            >
                                            <img src="/img/listen.svg" alt="">
                                            </button>
                                        <?php endif; ?>
                                    </div>
                                </div>

                                <!-- примеры-->

                                <?php if (isset($word['examples'][$meaning_count])) :?>
                                    <div class="examples_view">
                                        <?php foreach ($word['examples'][$meaning_count] as $example) :?>
                                            <?php if ($example->type == 0) : ?>
                                                <div class="example_div">
                                                    <span class="russian_example"> <?= $example->rus_value ?> </span> &ndash;
                                                    <span class="english_example"> <?= $example->tat_value ?> </span>
                                                </div>
                                             <?php else :?>
                                                <?php
                                                $idioma.='
                                                <div class="example_div">
                                                    <span class="russian_example">'.$example->rus_value.'</span> &ndash;
                                                    <span class="english_example"> '.$example->tat_value.'</span>
                                                </div>
                                                <br/>';
                                                ?>
                                            <?php endif;?>
                                        <?php endforeach;?>
                                    </div>
                                <?php endif;?>

                            <?php endforeach; ?>

                            <?php if ($idioma): ?>
                                <div class="idioma">
                                    <h4><?=Yii::t('app','Фразеологизмы')?></h4>
                                    <?=$idioma?>
                                </div>
                            <?php endif;?>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>


        <?php
        }
        ?>
    </div>

    <?php if ($reducto) : ?>
        <div class="txt_block">
            <input type="checkbox" id="raz"/><label for="raz"><?=Yii::t('app','Условные сокращения')?></label>
            <div id="skryt">
                    <div class="txt_block-content">
                        <div class="txt_block-row"><span class="field-content"><b>ав. </b> – авиация</span></div>
                        <div class="txt_block-row"><span class="field-content"><b>анат. </b> – анатомия</span></div>
                        <div class="txt_block-row"><span class="field-content"><b>арго </b> – жаргонное слово</span></div>
                        <div class="txt_block-row"><span class="field-content"><b>археол. </b> – археология</span></div>
                        <div class="txt_block-row"><span class="field-content"><b>архит. </b> – архитектура</span></div>
                        <div class="txt_block-row"><span class="field-content"><b>астр. </b> – астрономия</span></div>
                        <div class="txt_block-row"><span class="field-content"><b>безл. </b> – безличная форма</span></div>
                        <div class="txt_block-row"><span class="field-content"><b>биол. </b> – биология</span></div>
                        <div class="txt_block-row"><span class="field-content"><b>биохим. </b> – биологическая химия</span></div>
                        <div class="txt_block-row"><span class="field-content"><b>бот. </b> – ботаника</span></div>
                        <div class="txt_block-row"><span class="field-content"><b>бран. </b> – бранное слово, выражение</span></div>
                        <div class="txt_block-row"><span class="field-content"><b>буд. </b> – будущее время</span></div>
                        <div class="txt_block-row"><span class="field-content"><b>бухг. </b> – бухгалтерия</span></div>
                        <div class="txt_block-row"><span class="field-content"><b>в. </b> – век</span></div>
                        <div class="txt_block-row"><span class="field-content"><b>вводн. ел. </b> – вводное слово</span></div>
                        <div class="txt_block-row"><span class="field-content"><b>вет. </b> – ветеренария</span></div>
                        <div class="txt_block-row"><span class="field-content"><b>в знач. </b> – в значении</span></div>
                        <div class="txt_block-row"><span class="field-content"><b>вин. </b> – винительный (падеж)</span></div>
                        <div class="txt_block-row"><span class="field-content"><b>воен. </b> – военное дело</span></div>
                        <div class="txt_block-row"><span class="field-content"><b>воен.-мор. </b> – военно-морской термин</span></div>
                        <div class="txt_block-row"><span class="field-content"><b>возвр. </b> – возвратное местоимение</span></div>
                        <div class="txt_block-row"><span class="field-content"><b>вр. </b> – время</span></div>
                        <div class="txt_block-row"><span class="field-content"><b>в разл. знач. </b> – в различных значениях</span></div>
                        <div class="txt_block-row"><span class="field-content"><b>вспом. </b> – вспомогательный глагол</span></div>
                        <div class="txt_block-row"><span class="field-content"><b>выдел. </b> – выделительный союз, выделительная частица</span></div>
                        <div class="txt_block-row"><span class="field-content"><b>геогр. </b> – география</span></div>
                        <div class="txt_block-row"><span class="field-content"><b>геод. </b> – геодезия</span></div>
                        <div class="txt_block-row"><span class="field-content"><b>геол. </b> – геология</span></div>
                        <div class="txt_block-row"><span class="field-content"><b>геофиз. </b> – геофизика</span></div>
                        <div class="txt_block-row"><span class="field-content"><b>гидрол. </b> – гидрология</span></div>
                        <div class="txt_block-row"><span class="field-content"><b>гидротех. </b> – гидротехника</span></div>
                        <div class="txt_block-row"><span class="field-content"><b>гл. </b> – глагол; глагольный</span></div>
                        <div class="txt_block-row"><span class="field-content"><b>горн. </b> – горное дело</span></div>
                        <div class="txt_block-row"><span class="field-content"><b>грам. </b> – грамматика</span></div>
                        <div class="txt_block-row"><span class="field-content"><b>груб. </b> – грубое слово, выражение</span></div>
                        <div class="txt_block-row"><span class="field-content"><b>дат. </b> – дательный (падеж)</span></div>
                        <div class="txt_block-row"><span class="field-content"><b>деепр. </b> – деепричастие</span></div>
                        <div class="txt_block-row"><span class="field-content"><b>диал. </b> – диалектизм</span></div>
                        <div class="txt_block-row"><span class="field-content"><b>дип. </b> – дипломатия</span></div>
                        <div class="txt_block-row"><span class="field-content"><b>доп. </b> – дополнение</span></div>
                        <div class="txt_block-row"><span class="field-content"><b>др. </b> –другое, другие</span></div>
                        <div class="txt_block-row"><span class="field-content"><b>ед. </b> – единственное число</span></div>
                        <div class="txt_block-row"><span class="field-content"><b>ж. </b> – женский (род)</span></div>
                        <div class="txt_block-row"><span class="field-content"><b>ж.д. </b> – железнодорожный транспорт</span></div>
                        <div class="txt_block-row"><span class="field-content"><b>жив. </b> – живопись</span></div>
                        <div class="txt_block-row"><span class="field-content"><b>звукоподр. </b> – звукоподражательное слово</span></div>
                        <div class="txt_block-row"><span class="field-content"><b>знач. </b> – значение</span></div>
                        <div class="txt_block-row"><span class="field-content"><b>зоол. </b> – зоология</span></div>
                        <div class="txt_block-row"><span class="field-content"><b>и др. </b> – и другие</span></div>
                        <div class="txt_block-row"><span class="field-content"><b>изъясн. </b> – изъяснительный союз</span></div>
                        <div class="txt_block-row"><span class="field-content"><b>им </b> – именительный (падеж)</span></div>
                        <div class="txt_block-row"><span class="field-content"><b>ирон. </b> – в ироническом смысле, иронический</span></div>
                        <div class="txt_block-row"><span class="field-content"><b>иск. </b> – искусство</span></div>
                        <div class="txt_block-row"><span class="field-content"><b>ист. </b> – история</span></div>
                        <div class="txt_block-row"><span class="field-content"><b>и т. д. </b> – итак делее</span></div>
                        <div class="txt_block-row"><span class="field-content"><b>и т. п. </b> – и тому подобное</span></div>
                        <div class="txt_block-row"><span class="field-content"><b>карт. </b> – термин карточной игры</span></div>
                        <div class="txt_block-row"><span class="field-content"><b>кг. </b> – килограмм</span></div>
                        <div class="txt_block-row"><span class="field-content"><b>кино. </b> – кинемотография</span></div>
                        <div class="txt_block-row"><span class="field-content"><b>км. </b> – километр</span></div>
                        <div class="txt_block-row"><span class="field-content"><b>книжн. </b> – книжный</span></div>
                        <div class="txt_block-row"><span class="field-content"><b>к-рый (-ая, -ое) </b> – который (-ая, -ое)</span></div>
                        <div class="txt_block-row"><span class="field-content"><b>кратк. ф. </b> – краткая форма прилагательного</span></div>
                        <div class="txt_block-row"><span class="field-content"><b>кто-л. </b> – кто-либо</span></div>
                        <div class="txt_block-row"><span class="field-content"><b>кул. </b> – кулинария</span></div>
                        <div class="txt_block-row"><span class="field-content"><b>л. </b> – лицо (глагола)</span></div>
                        <div class="txt_block-row"><span class="field-content"><b>ласк. </b> – ласкательная форма</span></div>
                        <div class="txt_block-row"><span class="field-content"><b>лингв. </b> – лингвистика</span></div>
                        <div class="txt_block-row"><span class="field-content"><b>лит. </b> – литература, литературоведение</span></div>
                        <div class="txt_block-row"><span class="field-content"><b>личн. </b> – личная форма глагола, личное местоимения</span></div>
                        <div class="txt_block-row"><span class="field-content"><b>лог. </b> – логика</span></div>
                        <div class="txt_block-row"><span class="field-content"><b>м. </b> – мужской (род)</span></div>
                        <div class="txt_block-row"><span class="field-content"><b>мат. </b> – математика</span></div>
                        <div class="txt_block-row"><span class="field-content"><b>мед. </b> – медицина</span></div>
                        <div class="txt_block-row"><span class="field-content"><b>межд. </b> – междометие</span></div>
                        <div class="txt_block-row"><span class="field-content"><b>мест. </b> – местоимение</span></div>
                        <div class="txt_block-row"><span class="field-content"><b>метео. </b> – метерология</span></div>
                        <div class="txt_block-row"><span class="field-content"><b>мин. </b> – минерология</span></div>
                        <div class="txt_block-row"><span class="field-content"><b>миф. </b> – мифология</span></div>
                        <div class="txt_block-row"><span class="field-content"><b>мм. </b> – миллиметр</span></div>
                        <div class="txt_block-row"><span class="field-content"><b>мн. </b> – множественное число</span></div>
                        <div class="txt_block-row"><span class="field-content"><b>мор. </b> – морской термин</span></div>
                        <div class="txt_block-row"><span class="field-content"><b>муз. </b> – музыка</span></div>
                        <div class="txt_block-row"><span class="field-content"><b>мус. </b> – мусульманский, относящийся к мусульманству</span></div>
                        <div class="txt_block-row"><span class="field-content"><b>накл. </b> – наклонение</span></div>
                        <div class="txt_block-row"><span class="field-content"><b>напр. </b> – например</span></div>
                        <div class="txt_block-row"><span class="field-content"><b>нареч. </b> – наречие</span></div>
                        <div class="txt_block-row"><span class="field-content"><b>наст. </b> – настоящее время</span></div>
                        <div class="txt_block-row"><span class="field-content"><b>неизм. </b> – неизменяемый</span></div>
                        <div class="txt_block-row"><span class="field-content"><b>нек-рый(-ая, -ое) </b> – некоторый (-ая, -ое)</span></div>
                        <div class="txt_block-row"><span class="field-content"><b>неодобр. </b> – неодобрительное</span></div>
                        <div class="txt_block-row"><span class="field-content"><b>неопр. </b> – неопределенная форма глагола, неопределенное местоимение</span></div>
                        <div class="txt_block-row"><span class="field-content"><b>нескл. </b> – несклоняемое слово</span></div>
                        <div class="txt_block-row"><span class="field-content"><b>несов. </b> – несовершенный вид глагола</span></div>
                        <div class="txt_block-row"><span class="field-content"><b>обл. </b> – областное слово, выражение</span></div>
                        <div class="txt_block-row"><span class="field-content"><b>обознач. </b> – обозначает, обозначение</span></div>
                        <div class="txt_block-row"><span class="field-content"><b>огранич. </b> – ограничительный союз, ограничительная частица</span></div>
                        <div class="txt_block-row"><span class="field-content"><b>однакр. </b> – однократный вид глагола; однократное действие</span></div>
                        <div class="txt_block-row"><span class="field-content"><b>определит. </b> – определительное местоимение</span></div>
                        <div class="txt_block-row"><span class="field-content"><b>отп. </b> – оптика</span></div>
                        <div class="txt_block-row"><span class="field-content"><b>относ. </b> – относительное слово, местоимение</span></div>
                        <div class="txt_block-row"><span class="field-content"><b>отриц. </b> – отрицание, отрицательный</span></div>
                        <div class="txt_block-row"><span class="field-content"><b>офиц. </b> – официальный термин, официальное выражение</span></div>
                        <div class="txt_block-row"><span class="field-content"><b>охот. </b> – охота</span></div>
                        <div class="txt_block-row"><span class="field-content"><b>п. </b> – падеж</span></div>
                        <div class="txt_block-row"><span class="field-content"><b>палеонт. </b> – палеонтология</span></div>
                        <div class="txt_block-row"><span class="field-content"><b>перен. </b> – переносно, в переносном значении</span></div>
                        <div class="txt_block-row"><span class="field-content"><b>перечисл. </b> – перечислительный</span></div>
                        <div class="txt_block-row"><span class="field-content"><b>повел. </b> – повелительное (наклонение)</span></div>
                        <div class="txt_block-row"><span class="field-content"><b>погов. </b> – поговорка</span></div>
                        <div class="txt_block-row"><span class="field-content"><b>полигр. </b> – полиграфия</span></div>
                        <div class="txt_block-row"><span class="field-content"><b>полит. </b> – политический термин</span></div>
                        <div class="txt_block-row"><span class="field-content"><b>понуд. </b> – понудительное (наклонение)</span></div>
                        <div class="txt_block-row"><span class="field-content"><b>подр.</b>.– подражательное слово</span></div>
                        <div class="txt_block-row"><span class="field-content"><b>посл. </b> – пословица</span></div>
                        <div class="txt_block-row"><span class="field-content"><b>поэт. </b> – поэтическое слово, выражение</span></div>
                        <div class="txt_block-row"><span class="field-content"><b>поясн. </b> – пояснительный союз</span></div>
                        <div class="txt_block-row"><span class="field-content"><b>пр. </b> – прочий, прочее</span></div>
                        <div class="txt_block-row"><span class="field-content"><b>превосх. </b> – превосходная степень</span></div>
                        <div class="txt_block-row"><span class="field-content"><b>предл. </b> – предложный падеж</span></div>
                        <div class="txt_block-row"><span class="field-content"><b>презр. </b> – презрительное</span></div>
                        <div class="txt_block-row"><span class="field-content"><b>пренебр. </b> – пренебрежительное</span></div>
                        <div class="txt_block-row"><span class="field-content"><b>прил. </b> – имя прилагательное</span></div>
                        <div class="txt_block-row"><span class="field-content"><b>присоед. </b> – присоединительный союз</span></div>
                        <div class="txt_block-row"><span class="field-content"><b>притяж. </b> – притяжательное местоимение</span></div>
                        <div class="txt_block-row"><span class="field-content"><b>прич. </b> – причастие</span></div>
                        <div class="txt_block-row"><span class="field-content"><b>прост. </b> – просторечие</span></div>
                        <div class="txt_block-row"><span class="field-content"><b>против. </b> – противительный союз</span></div>
                        <div class="txt_block-row"><span class="field-content"><b>прош. </b> – прошедшие время</span></div>
                        <div class="txt_block-row"><span class="field-content"><b>прям. </b> – в прямом значении</span></div>
                        <div class="txt_block-row"><span class="field-content"><b>психол. </b> – психология</span></div>
                        <div class="txt_block-row"><span class="field-content"><b>пчел. </b> – пчеловодство</span></div>
                        <div class="txt_block-row"><span class="field-content"><b>радио. </b> – радиоэлектроника, радиотехника</span></div>
                        <div class="txt_block-row"><span class="field-content"><b>разг. </b> – разговорное слово, выражение</span></div>
                        <div class="txt_block-row"><span class="field-content"><b>разд. </b> – разделительный союз</span></div>
                        <div class="txt_block-row"><span class="field-content"><b>рел. </b> – религия</span></div>
                        <div class="txt_block-row"><span class="field-content"><b>род. </b> – родительный (падеж)</span></div>
                        <div class="txt_block-row"><span class="field-content"><b>рыб. </b> – рыбаловство, рыбоводство</span></div>
                        <div class="txt_block-row"><span class="field-content"><b>с. </b> – средний (род)</span></div>
                        <div class="txt_block-row"><span class="field-content"><b>сад. </b> – садоводство</span></div>
                        <div class="txt_block-row"><span class="field-content"><b>сапожн. </b> – сапожное дело</span></div>
                        <div class="txt_block-row"><span class="field-content"><b>сказ. </b> – сказуемое</span></div>
                        <div class="txt_block-row"><span class="field-content"><b>сл. </b> – слово</span></div>
                        <div class="txt_block-row"><span class="field-content"><b>см. </b> – смотри</span></div>
                        <div class="txt_block-row"><span class="field-content"><b>собир. </b> – собирательное (существительное), собирательно</span></div>
                        <div class="txt_block-row"><span class="field-content"><b>сов</b>в–совершенный вид глагола</span></div>
                        <div class="txt_block-row"><span class="field-content"><b>соед. </b> – соединительный союз</span></div>
                        <div class="txt_block-row"><span class="field-content"><b>сопост. </b> – сопоставительный союз</span></div>
                        <div class="txt_block-row"><span class="field-content"><b>сочин. </b> – сочинительный союз</span></div>
                        <div class="txt_block-row"><span class="field-content"><b>спорт. </b> – физкультура и спорт</span></div>
                        <div class="txt_block-row"><span class="field-content"><b>спец. </b> – специальный термин</span></div>
                        <div class="txt_block-row"><span class="field-content"><b>сравн. </b> – сравнительная степень, сравнительный союз</span></div>
                        <div class="txt_block-row"><span class="field-content"><b>ст. </b> – степень</span></div>
                        <div class="txt_block-row"><span class="field-content"><b>стр. </b> – строительное дело</span></div>
                        <div class="txt_block-row"><span class="field-content"><b>сущ. </b> – имя существительное</span></div>
                        <div class="txt_block-row"><span class="field-content"><b>с.-х. </b> – сельское хозяйство, сельскохозяйственный</span></div>
                        <div class="txt_block-row"><span class="field-content"><b>тв. </b> – творительный (падеж)</span></div>
                        <div class="txt_block-row"><span class="field-content"><b>театр. </b> – театральный термин</span></div>
                        <div class="txt_block-row"><span class="field-content"><b>текст. </b> – текстильное дело</span></div>
                        <div class="txt_block-row"><span class="field-content"><b>тех. </b> – техника</span></div>
                        <div class="txt_block-row"><span class="field-content"><b>торг. </b> – торговля</span></div>
                        <div class="txt_block-row"><span class="field-content"><b>указ. </b> – указательное местоимение; указание, указывает</span></div>
                        <div class="txt_block-row"><span class="field-content"><b>уменьш. </b> – уменьшительная форма</span></div>
                        <div class="txt_block-row"><span class="field-content"><b>уменьш.-ласк. </b> – уменьшительно-ласкательная форма</span></div>
                        <div class="txt_block-row"><span class="field-content"><b>употр. </b> – употребляется</span></div>
                        <div class="txt_block-row"><span class="field-content"><b>усил. </b> – усилительная форма, усилительная частица</span></div>
                        <div class="txt_block-row"><span class="field-content"><b>усл. </b> – условная форма, условный союз</span></div>
                        <div class="txt_block-row"><span class="field-content"><b>уст. </b> – устаревшее слово, выражение</span></div>
                        <div class="txt_block-row"><span class="field-content"><b>уступ. </b> – уступительная форма, уступительный союз</span></div>
                        <div class="txt_block-row"><span class="field-content"><b>утв. </b> – утвердительная частица</span></div>
                        <div class="txt_block-row"><span class="field-content"><b>фарм. </b> – фармакология</span></div>
                        <div class="txt_block-row"><span class="field-content"><b>физ. </b> – физика</span></div>
                        <div class="txt_block-row"><span class="field-content"><b>физиол. </b> – физиология</span></div>
                        <div class="txt_block-row"><span class="field-content"><b>филос. </b> – философия</span></div>
                        <div class="txt_block-row"><span class="field-content"><b>фин. </b> – финансовый термин</span></div>
                        <div class="txt_block-row"><span class="field-content"><b>фолък. </b> – фольклор</span></div>
                        <div class="txt_block-row"><span class="field-content"><b>фото </b> – фотография</span></div>
                        <div class="txt_block-row"><span class="field-content"><b>хим. </b> – химия</span></div>
                        <div class="txt_block-row"><span class="field-content"><b>церк. </b> – церковное слово, выражение</span></div>
                        <div class="txt_block-row"><span class="field-content"><b>ч. </b> – число</span></div>
                        <div class="txt_block-row"><span class="field-content"><b>част. </b> – частица</span></div>
                        <div class="txt_block-row"><span class="field-content"><b>числ. </b> – имя числительное</span></div>
                        <div class="txt_block-row"><span class="field-content"><b>шутл. </b> – шутливое слово, выражение</span></div>
                        <div class="txt_block-row"><span class="field-content"><b>эк. </b> – экономика</span></div>
                        <div class="txt_block-row"><span class="field-content"><b>эл. </b> – электротехника, электричество</span></div>
                        <div class="txt_block-row"><span class="field-content"><b>этн. </b> – этнография</span></div>
                        <div class="txt_block-row"><span class="field-content"><b>юр. </b> – юридический термин</span></div>
                        <div class="txt_block-row"><span class="field-content"><p><b>Татарские</b></p></span></div>
                        <div class="txt_block-row"><span class="field-content"><b>мәс. </b> – мәсәлән</span></div>
                        <div class="txt_block-row"><span class="field-content"><b>һ.б. </b> – һәм башкалар</span></div>
                        <div class="txt_block-row"><span class="field-content"><b>һ.б.ш. </b> – һәм  башка шундыйлар</span></div>
                        <div class="txt_block-row"><span class="field-content"><b>иск. </b> – искергән сүз</span></div>
                        <div class="txt_block-row"><span class="field-content"><b>сөйл. </b> – сөйләү сүзе</span></div>
                    </div>
                </blockquote>
            </div>
        </div>
    <?php endif;?>

    <div class="block-text">
        <?php if ($langs->url == 'ru') {
            $translate = Yii::t('app','Перевод слова') . ' <b>«' . $word['word']->word . '»</b> ';
        } else {
            $translate = '<b>«' . \app\helpers\SlugHelper::mb_ucfirst(trim($word['word']->word)) . '»</b> ';
        } ?>
        <p><?=$translate?><?=Yii::t('app','с русского на татарский язык').'.'?></p>
        <p><?=Yii::t('app','Перевод слов с русского на татарский язык').'.'?></p>
    </div>

    <div class="member_popover hide">

    </div>

</div>
<?php
if (!$mobile) {
    $this->registerJsFile('/js/dictionary/mob_alert.js', ['depends' => 'yii\web\JqueryAsset']);
}

$script = <<< JS
    $('[data-toggle="popover"]').popover({
        html: true,
        trigger: 'hover',
        placement: 'top',
        content: function() {
          return $('.member_popover').html($(this).attr('data-content'));
        }
    });
JS;
$this->registerJs($script, yii\web\View::POS_READY);
?>
