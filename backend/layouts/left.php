<aside class="main-sidebar">

    <section class="sidebar">

        <?= dmstr\widgets\Menu::widget(
            [
                'options' => ['class' => 'sidebar-menu'],
                'items' => [
                    ['label' => 'Пользователи', 'icon' => 'user', 'url' => ['/backend/default/index']],
                    ['label' => 'Словарь', 'icon' => 'file-word-o', 'url' => ['/backend/dict-word']],

                    ['label' => 'О проекте', 'icon' => 'info', 'url' => ['/backend/info/update?id=2']],
                    [
                        'label' => 'Об авторе',
                        'icon' => 'info-circle',
                        'url' => '#',
                        'items' => [
                            ['label' => 'Биография', 'icon' => 'male', 'url' => ['/backend/info/update?id=1'],],
                            ['label' => 'Наследие', 'icon' => 'book', 'url' => ['/backend/info/update?id=3'],],
                            ['label' => 'Коллеги о авторе', 'icon' => 'users', 'url' => ['/backend/info-about-author/index'],],
                        ],
                    ],
                    [
                        'label' => 'Циататы',
                        'icon' => 'info-circle',
                        'url' => '#',
                        'items' => [
                            ['label' => 'Добавить', 'icon' => 'plus', 'url' => ['/backend/quotations/create'],],
                            ['label' => 'Список', 'icon' => 'list', 'url' => ['/backend/quotations/index'],],
                        ],
                    ],
                    ['label' => 'Переводы', 'icon' => 'language', 'url' => ['/translate']],
                    [
                        'label' => 'SEO',
                        'icon' => 'info-circle',
                        'url' => '#',
                        'items' => [
                            ['label' => 'Sitemap', 'icon' => 'xing', 'url' => ['/backend/seo/sitemap']],
                            ['label' => 'СЕО', 'icon' => 'internet-explorer', 'url' => ['/backend/seo']],
                        ],
                    ],

                ],
            ]
        ) ?>

    </section>

</aside>
