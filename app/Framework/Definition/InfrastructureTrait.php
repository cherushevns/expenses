<?php

namespace App\Framework\Definition;

use Core\Infrastructure\DataAccessors\Database\ConnectionInterface;
use Core\Infrastructure\DataAccessors\Database\DatabaseGateway;
use Doctrine\DBAL\DriverManager;
use Monolog\Handler\StreamHandler;
use Monolog\Logger as MonologLogger;
use Psr\Log\LoggerInterface;

trait InfrastructureTrait
{
    public static function getInfrastructure(): array
    {
        return [
            ConnectionInterface::class => new DatabaseGateway(
                DriverManager::getConnection([
                    'dbname' => $_SERVER['DB_NAME'],
                    'user' => $_SERVER['DB_USER'],
                    'password' => $_SERVER['DB_PASSWORD'],
                    'host' => $_SERVER['DB_HOST'],
                    'driver' => $_SERVER['DB_DRIVER'],
                    'port' => $_SERVER['DB_PORT'],
                    'charset' => $_SERVER['DB_CHARSET']
                ])
            ),
            LoggerInterface::class => self::getLogger(),
        ];
    }

    private static function getLogger(): LoggerInterface
    {
        $monolog = new MonologLogger('logger');
        $monolog->pushHandler(new StreamHandler(
            implode(
                DIRECTORY_SEPARATOR, [
                    DIR_ROOT,
                    'storage',
                    'info.log'
                ]
            )
        ));

        return $monolog;
    }
}