<?php

namespace App\Framework\Application;

use App\Controller\Auth;
use App\Controller\ExpenseCategory;
use Slim\App;
use Slim\Routing\RouteCollectorProxy;

trait RouteTrait
{
    public static function addRoutes(App $app): void
    {
        $app->group('/v1', function(RouteCollectorProxy $group): void {
            $group->group('/expense-category', function(RouteCollectorProxy $group): void {
                $group->post('', ExpenseCategory\CreateController::class);
                $group->put('/{id}', ExpenseCategory\UpdateController::class);
                $group->get('', ExpenseCategory\GetAllController::class);
                /*$group->group('/entry', function(RouteCollectorProxy $group): void {
                    $group->post('/{expenseId}', ExpenseEntry\CreateController::class);
                    $group->put('/{expenseId}/{id}', ExpenseEntry\UpdateController::class);
                    $group->get('/{expenseId}', ExpenseEntry\GetAllController::class);
                });*/
            });
            $group->group('/auth', function(RouteCollectorProxy $group): void {
                $group->post('/register', Auth\RegisterController::class);
                $group->post('/login', Auth\LoginController::class);
                $group->post('/logout', Auth\LogoutController::class);
            });
        });

        $app->addRoutingMiddleware();
    }
}