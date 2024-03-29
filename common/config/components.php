<?php
/**
 * Created by PhpStorm.
 * User: Kem Bi
 * Date: 04-Jun-18
 * Time: 11:02 AM
 */

return [
    'devicedetect' => [
        'class' => 'alexandernst\devicedetect\DeviceDetect',
    ],
    'authManager' => [
        'class' => yii\rbac\DbManager::class,
        'cache' => 'cache',
        'itemTable' => '{{%rbac_auth_item}}',
        'itemChildTable' => '{{%rbac_auth_item_child}}',
        'assignmentTable' => '{{%rbac_auth_assignment}}',
        'ruleTable' => '{{%rbac_auth_rule}}',
//            'defaultRoles' => ['user'],
    ],
    'cache' => [
        'class' => yii\caching\FileCache::class,
        'cachePath' => '@backend/runtime/cache'
    ],
    'queue' => [
        'class' => \yii\queue\db\Queue::class,
        'db' => 'db', // DB connection component or its config
        'tableName' => '{{%queue}}', // Table name
        'channel' => 'default', // Queue channel key
        'mutex' => \yii\mutex\MysqlMutex::class, // Mutex used to sync queries
    ],
    
    'i18n' => [
        'translations' => [
            'app' => [
                'class' => yii\i18n\PhpMessageSource::class,
                'basePath' => '@common/messages',
            ],
            '*' => [
                'class' => yii\i18n\PhpMessageSource::class,
                'basePath' => '@common/messages',
                'fileMap' => [
                    'common' => 'common.php',
                    'backend' => 'backend.php',
                    'frontend' => 'frontend.php',
                ],
            ],
        ],
    ],
    'assetManager' => [
        'class' => yii\web\AssetManager::class,
        'linkAssets' => LINK_ASSETS,
        'appendTimestamp' => true,
        'forceCopy' => true,
        'hashCallback' => function ($path) {
            return hash('md4', $path);
        }
    ],
    'formatter' => [
        'class' => 'yii\i18n\Formatter',
        'nullDisplay' => '-',
        'dateFormat' => 'php:d-m-Y',
        'datetimeFormat' => 'php:d-m-Y H:i:s',
        'timeFormat' => 'php:H:i:s',
        'locale' => 'vi_VN',
        'decimalSeparator' => '.',
        'thousandSeparator' => ',',
//        'currencyCode' => '₫',
    ],
    'commandBus' => [
        'class' => trntv\bus\CommandBus::class,
        'middlewares' => [
            [
                'class' => trntv\bus\middlewares\BackgroundCommandMiddleware::class,
                'backgroundHandlerPath' => '@console/yii',
                'backgroundHandlerRoute' => 'command-bus/handle',
            ]
        ]
    ],
];
