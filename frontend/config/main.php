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
    'controllerNamespace' => 'frontend\controllers',
    'homeUrl' => '/',
    'language' => 'en-EN',
    'components' => [
        'request' => [
            'class' => 'frontend\components\LanguageRequest',
            'csrfParam' => '_csrf-frontend',
            'baseUrl' => '',
        ],
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
            'identityCookie' => ['name' => '_identity-frontend'],
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
        'formatter' => [
            'class' => 'common\components\MyFormatter',
        ],
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
                'login' => 'site/login',
                'signup' => 'site/signup',
                'page/<id:.+>' => 'site/page',
                'user/purchased' => 'seller-query/purchased',
                'user/products' => 'product/index',
                'user/product/create' => 'product/create',
                'user/product/update' => 'product/update',
                'user/requests' => 'seller-query',
                'user/queries' => 'query/index',
                'user/request/' => 'seller-query/view',
                'user/orders' => 'order/index',
//                'reset-password' => 'site/request-password-reset',
            ],
        ],

    ],
    'params' => $params,
];
