<?php

$config = [
    'components' => [
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => '',
        ],
    ],
];

if (YII_DEBUG === true) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => \yii\debug\Module::class,
        'allowedIPs' => ['*'],
    ];
}
if (YII_ENV_DEV === true) {
    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => \yii\gii\Module::class,
        'allowedIPs' => ['*'],
        /*
        'generators' => [
            'crud' => [
                'class' => 'backend\generators\crudSteps\Generator',
                'templates' => [
                    'default' => '@backend/generators/crudSteps/steps',
                ],
            ],
            'model' => [
                'class' => 'backend\generators\model\Generator',
                'templates' => [
                    'default' => '@backend/generators/model/default',
                ],
            ],
        ],
        */
    ];
}

return $config;
