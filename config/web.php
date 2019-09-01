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
                    'project/<name:\w+>' => 'project/show',
                ],
            ],
        ],
    ]
);
