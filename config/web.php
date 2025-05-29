<?php

$params = require(__DIR__ . '/params.php');

$config = [
    'id' => 'basic',
    'language' => 'ru-RU',
    'defaultRoute' => 'dictionary/default/words',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'layout' => '@app/views/layouts/dictionary',
    'components' => [
        'assetManager' => [
            'appendTimestamp' => true,
            'bundles' => [
                'kartik\form\ActiveFormAsset' => [
                    'bsDependencyEnabled' => false // do not load bootstrap assets for a specific asset bundle
                ],
            ],
        ],
        'request' => [
            'cookieValidationKey' => 'xQXwobLIR1w4qbUsgy8tUg13_mUNlAjl',
            'class' => 'app\components\LangRequest'
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'user' => [
            'class' => 'webvimark\modules\UserManagement\components\UserConfig',
            'on afterLogin' => function($event) {
                \webvimark\modules\UserManagement\models\UserVisitLog::newVisitor($event->identity->id);
            }
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            'useFileTransport' => true,
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'db' => require(__DIR__ . '/db.php'),
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'class'=>'app\components\LangUrlManager',

            'rules' => [
                '/' => 'dictionary',
                'login' => 'user-management/auth/login',
                'logout' => 'user-management/auth/logout',

                '/words' => '/dictionary/default/words',
                '/author' => '/dictionary/default/author',
                '/about' => '/dictionary/default/about',
                '/search' => '/dictionary/default/search',

                'api' => 'api',

                '/app' => '/dictionary/app',
                '/app/words/<word:\w+>' => '/dictionary/app/words',
                '/app/author' => '/dictionary/app/author',
                '/app/about' => '/dictionary/app/about',
                '/app/search' => '/dictionary/app/search',

                '/dictionary/default/words' => '/site/error',
                '/dictionary/default/author' => '/site/error',
                '/dictionary/default/about' => '/site/error',

                'alphabet/<id:\d+>' => 'project/default/index',

                'user-management/auth/login' => 'site/error',
                'user-management/auth/logout' => 'site/error',

                [
                    'class'=>'app\components\WordsUrlManager'
                ],
                '<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
            ],
        ],
    ],
    'modules' => [
        'user-management' => [
            'class' => 'webvimark\modules\UserManagement\UserManagementModule',
            'layout' => '@app/backend/layouts/main',
            'on beforeAction'=>function(yii\base\ActionEvent $event) {
                if ( $event->action->uniqueId == 'user-management/auth/login' )
                {
                    $event->action->controller->layout = 'loginLayout.php';
                };
            },
        ],
        'dictionary' => [
            'class' => 'app\modules\dictionary\Module',
            'layout' => '@app/views/layouts/dictionary',
        ],
        'files' => [
            'class' => 'app\modules\files\Module',
        ],
        'backend' => [
            'class' => 'app\backend\BackendModule',
            'layout' => '@app/backend/layouts/main',
            'defaultRoute' => 'dict-word'
        ],
        'translate' => [
            'class' => 'app\modules\translate\Module',
            'layoutPath' => '@app/backend/layouts',
            'layout' => 'main'
        ],
        'mobile' => [
            'class' => 'app\modules\mobile\Module',
            'layout' => '@app/views/layouts/mobile',
        ],
        'project' => [
            'class' => 'app\modules\project\Module',
            'layout' => '@app/modules/project/views/layouts/main',
        ],
    ],
    'params' => $params,
];
if (file_exists(__DIR__ . '/db-local.php')){
    $config['components']['db'] = require(__DIR__ . '/db-local.php');
}

if (YII_ENV_DEV) {
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
        'allowedIPs' => ['127.0.0.1', '::1'],
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
        'allowedIPs' => ['127.0.0.1', '::1'],
    ];
}

return $config;
