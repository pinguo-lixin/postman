<?php

return [
    'id' => 'postman-doc',
    'name' => 'Postman Doc',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'aliases' => [
        '@App' => '@app/App',
        '@postman' => '@app/postman',
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
