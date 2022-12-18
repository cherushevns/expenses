<?php

namespace App\Framework\Application;

use App\Framework\Middleware\AuthMiddleware;
use Core\BusinessRules\Auth\ClearAccessTokensByUserIdInterface;
use Core\BusinessRules\Auth\GetAccessTokenByTokenInterface;
use Slim\App;

trait MiddlewareTrait
{
    public static function addMiddlewares(App $app): void
    {
        $app->addMiddleware(new AuthMiddleware(
            $app->getContainer()->get(GetAccessTokenByTokenInterface::class),
            $app->getContainer()->get(ClearAccessTokensByUserIdInterface::class)
        ));
    }
}