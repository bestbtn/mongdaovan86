<?php
/**
 * Created by PhpStorm.
 * User: Kem Bi
 * Date: 06-Jul-18
 * Time: 4:00 PM
 */
<<<<<<< HEAD
$config = [
    'defaultRoute' => 'auth/index',
=======

$config = [
    'defaultRoute' => 'user/index',
>>>>>>> master
    'basePath' => dirname(__FILE__) . DIRECTORY_SEPARATOR . '..',
    'aliases' => [
        '@authweb' => '@modava/auth/web',
    ],
    'components' => [
        'errorHandler' => [
            'class' => \modava\auth\components\MyErrorHandler::class,
        ],
    ],
    'params' => require __DIR__ . '/params.php',
];

return $config;
