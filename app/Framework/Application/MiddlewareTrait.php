<?php

namespace App\Framework\Application;

use App\Framework\Middleware\AuthMiddleware;
use Core\BusinessRules\Common\Auth\GetAuthorizedUserIdInterface;
use League\OpenAPIValidation\PSR15\SlimAdapter;
use League\OpenAPIValidation\PSR15\ValidationMiddlewareBuilder;
use Slim\App;

trait MiddlewareTrait
{
    public static function addMiddlewares(App $app): void
    {
        self::addAuthMiddleware($app);
        self::addValidationMiddleware($app);
    }

    private static function addAuthMiddleware(App $app): void
    {
        $app->addMiddleware(new AuthMiddleware(
            $app->getContainer()->get(GetAuthorizedUserIdInterface::class)
        ));
    }

    private static function addValidationMiddleware(App $app): void
    {
        /*$yamlFileConfigPath = DIR_ROOT . '/app/Framework/OpenApi/api.yaml';

        $validationMiddlewareBuilder = new ValidationMiddlewareBuilder();
        $psr15Middleware = $validationMiddlewareBuilder->fromYamlFile($yamlFileConfigPath)->getValidationMiddleware();
        $slimMiddleware = new SlimAdapter($psr15Middleware);
        $app->add($slimMiddleware);*/
    }
}