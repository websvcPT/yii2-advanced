<?php

$MYSQL_HOST = cfgEnv('MYSQL_HOST', 'mysql');
$MYSQL_PORT = intval(cfgEnv('MYSQL_PORT', 3306));
$MYSQL_USERNAME = cfgEnv('MYSQL_USERNAME', 'root');
$MYSQL_PASSWORD = cfgEnv('MYSQL_PASSWORD', 'root');
$MYSQL_DATABASE = cfgEnv('MYSQL_DATABASE', 'baa_system');

return [
    'components' => [
        'db' => [
            'class' => \yii\db\Connection::class,
            'dsn' => 'mysql:host=' . $MYSQL_HOST . ';port=' . $MYSQL_PORT . ';dbname=' . $MYSQL_DATABASE,
            'username' => $MYSQL_USERNAME,
            'password' => $MYSQL_PASSWORD,
            'charset' => 'utf8',
        ],
        'mailer' => [
            'class' => \yii\symfonymailer\Mailer::class,
            'viewPath' => '@common/mail',
            'transport' => [
                'scheme' => 'smtps',
                'host' => '',
                'username' => '',
                'password' => '',
                'port' => 465,
                'dsn' => 'native://default',
            ],
            // send all mails to a file by default. You have to set
            // 'useFileTransport' to false and configure transport
            // for the mailer to send real emails.
            'useFileTransport' => cfgEnvBoolean(cfgEnv('MAILER_FILE_TRANSPORT', 'true')),
        ],
    ],
];
