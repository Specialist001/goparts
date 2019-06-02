<?php
$params = array_merge(
    require __DIR__ . '/../../common/config/params.php',
    require __DIR__ . '/../../common/config/params-local.php',
    require __DIR__ . '/params.php',
    require __DIR__ . '/params-local.php'
);

return [
    'id' => 'app-frontend',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'controllerNamespace' => 'api\controllers',
    'homeUrl' => '/',
    'language' => 'en-EN',
    'components' => [
        'request' => [
            'class' => 'api\components\LanguageRequest',
            'csrfParam' => '_csrf-frontend',
            'baseUrl' => '/api',
        ],
        'user' => [
            'identityClass' => 'common\models\User',
            'enableSession' => false,
            'enableAutoLogin' => true,
            'identityCookie' => ['name' => '_identity-api', 'httpOnly' => true],
        ],
        'session' => [
            // this is the name of the session cookie used for login on the frontend
            'name' => 'advanced-frontend',
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
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],

        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
//            'class'=>'api\components\LanguageUrlManager',
            'rules' => [
                '<controller:\w+>/<action:\w+>/<id:\d+>'=>'<controller>/<action>',
            ]
        ],

    ],
    'params' => $params,
];
