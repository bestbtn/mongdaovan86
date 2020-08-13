<?php

$config = [
    'id' => 'backend',
    'basePath' => dirname(__DIR__),
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@backendWeb' => '@backend/web'
    ],
    'name' => SITE_ADMIN,
    'controllerNamespace' => 'backend\controllers',
    'defaultRoute' => 'site/index',
    'components' => require __DIR__ . '/components.php',
    'modules' => require __DIR__ . '/modules.php',
    'as globalAccess' => require __DIR__ . '/behaviors.php',
    'params' => require __DIR__ . '/params.php',
];

if (YII2_ENV_DEV) {
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
        'allowedIPs' => ['127.0.0.1', '::1'],
        'generators' => [
            'module' => [
                'class' => \modava\generators\module\Generator::class,
<<<<<<< HEAD
                'templates' => ['generators' => '@app/backend/generators/module/Generator']
            ],
            'model' => [
                'class' => \modava\generators\model\Generator::class,
                'templates' => ['generators' => '@app/backend/generators/model/Generator']
            ],
            'crud' => [
                'class' => \modava\generators\crud\Generator::class,
                'templates' => ['generators' => '@app/backend/generators/crud/Generator']
=======
//                'templates' => ['generators' => '@app/backend/generators/module/Generator']
            ],
            'model' => [
                'class' => \modava\generators\model\Generator::class,
//                'templates' => ['generators' => '@app/backend/generators/model/Generator']
            ],
            'crud' => [
                'class' => \modava\generators\crud\Generator::class,
//                'templates' => ['generators' => '@app/backend/generators/crud/Generator']
>>>>>>> master
            ],
        ]
    ];
}

return $config;
