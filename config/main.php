<?php

return [
    'id' => 'postman-doc',
    'name' => 'Postman Doc',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'aliases' => [
        '@App' => '@app/App',
        '@postman' => '@app/postman',
        '@npm' => '@vendor/npm-asset',
        '@bower' => '@vendor/bower-asset',
    ],
    'components' => [
        'log' => [
            'targets' => [
                'file' => [
                    'class' => \yii\log\FileTarget::class,
                    'levels' => 0,
                    'logFile' => '@runtime/application.log',
                    'logVars' => [],
                ],
            ],
        ],
    ],
];
