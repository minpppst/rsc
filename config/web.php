<?php

$params = require(__DIR__ . '/params.php');

$config = [
    'id' => 'basic',
    'language' => 'es',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'components' => [
        'formatter' => [
            'dateFormat' => 'dd/MM/yyyy',
            'decimalSeparator' => ',',
            'thousandSeparator' => '.',
            'currencyCode' => 'Bs.', //VEF
        ],        
        'authManager' => [
            'class' => 'yii\rbac\DbManager',
        ],
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => '123456',
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'user' => [
            'class'=>'yii\web\User',
            'identityClass' => 'johnitvn\userplus\basic\models\UserAccounts',
            'loginUrl'=>'index.php?r=/user/security/login'
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
        'db' => require(__DIR__ . '/db.php'),
    ],
    'modules' => [
        'backuprestore' => [
            'class' => '\oe\modules\backuprestore\Module',
        ],
        'user' => [
            'class' => 'johnitvn\userplus\basic\Module',
        ],

         'audit' => [
        'class' => 'bedezign\yii2\audit\Audit',
        'db' => 'db', // Name of the component to use for database access
        'trackActions' => ['*'], // List of actions to track. '*' is allowed as the last character to use as wildcard
        'ignoreActions' => 'debug/*', // Actions to ignore. '*' is allowed as the last character to use as wildcard (eg 'debug/*')
        //'truncateChance' => 75, // Chance in % that the truncate operation will run, false to not run at all
        'maxAge' => 'debug', // Maximum age (in days) of the audit entries before they are truncated
        'accessUsers' => [1, 2], // (List of) user(s) IDs with access to the viewer, null for everyone (if the role matches)
        'accessRoles' => ['admin'], // (List of) role(s) with access to the viewer, null for everyone (if the user matches)
    ],

        'rbac' => [
            'class' => 'johnitvn\rbacplus\Module',
            'userModelClassName'=>null,
            'userModelIdField'=>'id',
            'userModelLoginField'=>'username',
            'userModelLoginFieldLabel'=>null,
            'userModelExtraDataColumls'=>null,
            'beforeCreateController'=>null,
            'beforeAction'=>null
        ],
        'gridview' => [
            'class' => 'kartik\grid\Module',
        ],
    ],
    'params' => $params,
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
    ];
}

return $config;
