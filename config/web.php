<?php

$params = require __DIR__ . '/params.php';
$db = require __DIR__ . '/db.php';

$config = [
    'id' => 'test-coin',
    'name' => 'Profit Calculator',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'language' => 'ru',
    'aliases' => [
	'@bower' => '@vendor/bower-asset',
	'@npm' => '@vendor/npm-asset',
    ],
    'components' => [
	'request' => [
	    'cookieValidationKey' => 'mUo2ZhrLIEe79pQhbrVtLlH4Z5Cxzfe1',
	],
	'cache' => [
	    'class' => 'yii\caching\FileCache',
	],
	'user' => [
	    'identityClass' => 'app\models\User',
	    'enableAutoLogin' => true,
	],
	'errorHandler' => [
	    'errorAction' => 'site/error',
	],
	'mailer' => [
	    'class' => 'yii\swiftmailer\Mailer',
	    // send all mails to a file by default. You have to set
	    // 'useFileTransport' to false and configure a transport
	    // for the mailer to send real emails.
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
	'db' => $db,
	'coinapi' => [
	    'class' => 'app\components\CoinAPI',
	    'ApiKey' => 'BA786520-EE1E-47BD-84B6-CE4D52F36795',
	],
	'ratecache' => [
	    'class' => 'app\components\RateCache',
	],
    ],
    'params' => $params,
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
	'class' => 'yii\debug\Module',
	    // uncomment the following to add your IP if you are not connecting from localhost.
	    //'allowedIPs' => ['127.0.0.1', '::1'],
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
	'class' => 'yii\gii\Module',
	    // uncomment the following to add your IP if you are not connecting from localhost.
	    //'allowedIPs' => ['127.0.0.1', '::1'],
    ];
}

return $config;
