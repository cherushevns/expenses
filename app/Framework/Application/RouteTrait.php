<?php

namespace App\Framework\Application;

use App\Controller\Auth;
use App\Controller\Expense;
use App\Controller\ExpenseRecord;
use Slim\App;
use Slim\Routing\RouteCollectorProxy;

trait RouteTrait
{
    public static function addRoutes(App $app): void
    {
        $app->group('/v1', function(RouteCollectorProxy $group): void {
            $group->group('/expense', function(RouteCollectorProxy $group): void {
                $group->post('', Expense\CreateController::class);
                $group->put('/{id}', Expense\UpdateController::class);
                $group->get('', Expense\GetAllController::class);
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