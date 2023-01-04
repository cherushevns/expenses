<?php

namespace App\Framework;

use App\Framework\Application\MiddlewareTrait;
use App\Framework\Application\RouteTrait;
use Dotenv\Dotenv;
use Fig\Http\Message\StatusCodeInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Log\LoggerInterface;
use Slim\App;
use Slim\Exception\HttpException;
use Slim\Factory\AppFactory;
use Throwable;

class AppBuilder
{
    use RouteTrait;
    use MiddlewareTrait;

    public static function buildHttpApp(): App
    {
        $dotenv = Dotenv::createImmutable(DIR_ROOT);
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

        $container = ContainerBuilder::build();
        AppFactory::setContainer($container);
        $app = AppFactory::create();

        self::addRoutes($app);

        // @todo добавить валидацию OpenAPI
        $app->addBodyParsingMiddleware();
        self::addMiddlewares($app);

        return $app;
    }
}