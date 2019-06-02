<?php
$params = array_merge(
    require __DIR__ . '/../../common/config/params.php',
    require __DIR__ . '/../../common/config/params-local.php',
    require __DIR__ . '/params.php',
    require __DIR__ . '/params-local.php'
);

return [
    'id' => 'app-backend',
    'basePath' => dirname(__DIR__),
    'controllerNamespace' => 'backend\controllers',
    'language' => 'en-EN',
    'bootstrap' => ['log','rbac'],
    'modules' => [
        'rbac' => [
            'class' => 'mdm\admin\Module',
            'layout' => null,
            'menus' => [
                'assignment' => [
                    'label' => 'Grant Access' // change label
                ],
                'route' => null, // disable menu
            ],
            'mainLayout' => '@backend/views/layouts/main.php',
            'controllerMap' => [
                'assignment' => [
                    'class' => 'mdm\admin\controllers\AssignmentController',
                    'userClassName' => 'common\models\User',
                    'idField' => 'id',
                    'usernameField' => 'username',
//                    'fullnameField' => 'profile.full_name',
//                    'extraColumns' => [
//                        [
//                            'attribute' => 'full_name',
//                            'label' => 'Full Name',
//                            'value' => function($model, $key, $index, $column) {
//                                return $model->profile->full_name;
//                            },
//                        ],
//                        [
//                            'attribute' => 'dept_name',
//                            'label' => 'Department',
//                            'value' => function($model, $key, $index, $column) {
//                                return $model->profile->dept->name;
//                            },
//                        ],
//                        [
//                            'attribute' => 'post_name',
//                            'label' => 'Post',
//                            'value' => function($model, $key, $index, $column) {
//                                return $model->profile->post->name;
//                            },
//                        ],
//                    ],
                    'searchClass' => 'backend\models\UserSearch'
                ],
            ],
        ],
    ],
    'as access' => [
        'class' => 'mdm\admin\components\AccessControl',
        'allowActions' => [
            'user/*',
            'site/*',
            'admin/*',
            'rbac/*',
            'debug/*',
            'gii/*',
            'api/*',
//            'store-categories/*',
            // The actions listed here will be allowed to everyone including guests.
            // So, 'admin/*' should not appear here in the production, of course.
            // But in the earlier stages of your development, you may probably want to
            // add a lot of actions here until you finally completed setting up rbac,
            // otherwise you may not even take a first step.
        ]
    ],
    'components' => [
        'request' => [
            'class' => 'frontend\components\LanguageRequest',
            'csrfParam' => '_csrf-backend',
            'baseUrl' => '/admin',
        ],
        'assetManager' => [
            'bundles' => [
                'dmstr\web\AdminLteAsset' => [
                    'skin' => 'skin-blue',
                ],
            ],
        ],
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
            'identityCookie' => ['name' => '_identity-backend', 'httpOnly' => true],
        ],
        'session' => [
            // this is the name of the session cookie used for login on the backend
            'name' => 'advanced-backend',
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
                'admin' => 'site/index',
                'login' => 'site/login'
            ],
        ],
    ],
    'params' => $params,
];
