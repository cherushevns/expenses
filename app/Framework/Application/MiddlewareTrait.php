<?php

namespace App\Framework\Application;

use App\Framework\Middleware\AuthMiddleware;
use Core\BusinessRules\Common\Auth\GetAuthorizedUserIdInterface;
use Slim\App;

trait MiddlewareTrait
{
    public static function addMiddlewares(App $app): void
    {
        $app->addMiddleware(new AuthMiddleware(
            $app->getContainer()->get(GetAuthorizedUserIdInterface::class)
        ));
    }
}