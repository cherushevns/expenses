<?php

namespace App\Framework\Application;

use App\Controller\Auth\LoginController;
use App\Controller\Auth\LogoutController;
use App\Controller\Auth\RegisterController;
use App\Controller\RegularExpense\CreateRegularExpenseController;
use App\Controller\RegularExpense\GetRegularExpensesController;
use App\Controller\RegularExpense\UpdateRegularExpenseController;
use Slim\App;
use Slim\Routing\RouteCollectorProxy;

trait RouteTrait
{
    public static function addRoutes(App $app): void
    {
        $app->group('/v1', function(RouteCollectorProxy $group): void {
            $group->group('/regular-expense', function(RouteCollectorProxy $group): void {
                $group->post('', CreateRegularExpenseController::class);
                $group->put('/{id}', UpdateRegularExpenseController::class);
                $group->get('', GetRegularExpensesController::class);
            });
            $group->group('/auth', function(RouteCollectorProxy $group): void {
                $group->post('/register', RegisterController::class);
                $group->post('/login', LoginController::class);
                $group->post('/logout', LogoutController::class);
            });
        });

        $app->addRoutingMiddleware();
    }
}