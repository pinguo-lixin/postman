<?php

use yii\helpers\ArrayHelper;

return ArrayHelper::merge(
    require __DIR__ . '/main.php',
    [
        'controllerNamespace' => 'App\\Controller',
        'components' => [
            'urlManager' => [
                'enablePrettyUrl' => true,
                'showScriptName' => false,
                'rules' => [
                    'project/download' => 'project/download',
                    'project/upload' => 'project/upload',
                    'project/<name:\w+>' => 'project/show',
                ],
            ],
        ],
    ]
);
