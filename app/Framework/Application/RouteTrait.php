<?php

namespace App\Framework\Application;

use App\Controller\Auth;
use App\Controller\ExpenseCategory;
use App\Controller\PlannedExpense;
use App\Controller\ActualExpense;
use App\Controller\Income;
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
            $group->group('/actual-expense', function(RouteCollectorProxy $group): void {
                $group->post('', ActualExpense\CreateController::class);
                $group->delete('/{id}', ActualExpense\DeleteController::class);
            });
            $group->group('/income', function(RouteCollectorProxy $group): void {
                $group->post('', Income\CreateController::class);
                $group->delete('/{id}', Income\DeleteController::class);
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