<?php

namespace App\Framework\Application;

use App\Controller\Auth;
use App\Controller\ExpenseCategory;
use App\Controller\PlannedExpense;
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
            });
            $group->group('/planned-expense', function(RouteCollectorProxy $group): void {
                $group->post('', PlannedExpense\CreateController::class);
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