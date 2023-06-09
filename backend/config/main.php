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
    'bootstrap' => ['log'],
//    'language' => 'ru',
    'modules' => [
        'gridview' => [
            'class' => '\kartik\grid\Module'
        ],
        'settings' => [
            'class' => 'backend\modules\settings\Settings',
        ],
    ],

    'components' => [
        'i18n' => [
            'translations' => [
                'app' => [
                    'class' => 'yii\i18n\PhpMessageSource',
//                    'basePath' => '@backend/messages',
//                    'sourceLanguage' => 'ru',
                    'fileMap' => [
                        'app' => 'app.php',
                        'app/error' => 'error.php',
                    ],
                ],
            ],
        ],
        'request' => [
            'csrfParam' => '_csrf-backend',
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
                    'class' => \yii\log\FileTarget::class,
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'mailer' => [
          'class' => yii\swiftmailer\Mailer::class,
          'useFileTransport' => false,
        ],
        'authManager' => [
            'class' => 'yii\rbac\DbManager',
            'defaultRoles'=>['guest'],
                ],

        'errorHandler' => [
            'errorAction' => 'site/error',
        ],

        'MyComponent' => [
            'class' => 'backend\components\MyComponent',
        ],
    ],
    'as beforeRequest'=>[
        'class'=>'backend\components\CheckIfLoggedIn',
    ],
    'params' => $params,
];
