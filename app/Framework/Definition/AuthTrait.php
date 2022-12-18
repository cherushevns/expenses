<?php

namespace App\Framework\Definition;

use Core\BusinessRules\Auth\CheckIsUserExistsByLoginInterface;
use Core\BusinessRules\Auth\CreateUserInterface;
use Core\BusinessRules\Auth\GetUserIdByLoginInterface;
use Core\BusinessRules\Auth\LoginUserInterface;
use Core\BusinessRules\Auth\LogoutUserInterface;
use Core\BusinessRules\Auth\ValidateUserPasswordInterface;
use Core\Interactors\Auth\CheckIsUserExistsByLoginAction;
use Core\Interactors\Auth\CreateUserAction;
use Core\Interactors\Auth\GetUserIdByLoginAction;
use Core\Interactors\Auth\LoginUserAction;
use Core\Interactors\Auth\LogoutUserAction;
use Core\Interactors\Auth\ValidateUserPasswordAction;
use function DI\autowire;

trait AuthTrait
{
    public static function getAuth(): array
    {
        return [
            GetUserIdByLoginInterface::class => autowire(GetUserIdByLoginAction::class),
            CheckIsUserExistsByLoginInterface::class => autowire(CheckIsUserExistsByLoginAction::class),
            CreateUserInterface::class => autowire(CreateUserAction::class),
            LoginUserInterface::class => autowire(LoginUserAction::class),
            ValidateUserPasswordInterface::class => autowire(ValidateUserPasswordAction::class),
            LogoutUserInterface::class => autowire(LogoutUserAction::class)
        ];
    }
}