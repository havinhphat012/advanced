<?php
return [
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm' => '@vendor/npm-asset',
    ],
    'vendorPath' => dirname(__DIR__, 2) . '/vendor',
    'components' => [
        'db' => [
            'class' => 'yii\db\Connection',
            'dsn' => 'mysql:host=localhost;dbname=yii2_advanced_new',
            'username' => 'root',
            'password' => '',
            'charset' => 'utf8',
        ],
        'db2' => [
            'class' => 'yii\db\Connection',
            'dsn' => 'mysql:host=localhost;dbname=yii2_advanced_new_db2',
            'username' => 'root',
            'password' => '',
            'charset' => 'utf8',
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            'viewPath' => '@common/mail',
            'useFileTransport' => true,
        ],
    ],


//        'cache' => [
//            'class' => \yii\caching\FileCache::class,
//        ],
//        'i18n' => [
//            'translations' => [
//                '*' => [
//                    'class' => 'yii\i18n\DbMessageSource',
//                    'sourceLanguage' => 'en',
//                ]
//            ],
//        ],
];
