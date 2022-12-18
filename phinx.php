<?php

use Dotenv\Dotenv;

require __DIR__ . '/vendor/autoload.php';

$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();
$dotenv->required([
    'DB_NAME',
    'DB_HOST',
    'DB_USER',
    'DB_PASSWORD',
    'DB_DRIVER',
    'DB_PORT',
    'DB_CHARSET',
]);

return
[
    'paths' => [
        'migrations' => '%%PHINX_CONFIG_DIR%%/db/migrations',
        'seeds' => '%%PHINX_CONFIG_DIR%%/db/seeds'
    ],
    'environments' => [
        'default_migration_table' => 'phinxlog',
        'default_environment' => 'development',
        'production' => [
            'adapter' => 'mysql',
            'host' => $_SERVER['DB_HOST'],
            'name' => $_SERVER['DB_NAME'],
            'user' => $_SERVER['DB_USER'],
            'pass' => $_SERVER['DB_PASSWORD'],
            'port' => $_SERVER['DB_PORT'],
            'charset' => $_SERVER['DB_CHARSET'],
        ],
        'development' => [
            'adapter' => 'mysql',
            'host' => $_SERVER['DB_HOST'],
            'name' => $_SERVER['DB_NAME'],
            'user' => $_SERVER['DB_USER'],
            'pass' => $_SERVER['DB_PASSWORD'],
            'port' => $_SERVER['DB_PORT'],
            'charset' => $_SERVER['DB_CHARSET'],
        ],
        'testing' => [
            'adapter' => 'mysql',
            'host' => $_SERVER['DB_HOST'],
            'name' => $_SERVER['DB_NAME'],
            'user' => $_SERVER['DB_USER'],
            'pass' => $_SERVER['DB_PASSWORD'],
            'port' => $_SERVER['DB_PORT'],
            'charset' => $_SERVER['DB_CHARSET'],
        ]
    ],
    'version_order' => 'creation'
];
