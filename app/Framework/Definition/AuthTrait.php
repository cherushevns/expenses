<?php

namespace App\Framework\Definition;

use Core\BusinessRules\Auth\CheckIsUserExistsByLoginInterface;
use Core\BusinessRules\Auth\ClearAccessTokensByUserIdInterface;
use Core\BusinessRules\Auth\CreateUserInterface;
use Core\BusinessRules\Auth\GetAccessTokenByTokenInterface;
use Core\BusinessRules\Auth\GetUserIdByLoginInterface;
use Core\BusinessRules\Auth\LoginUserInterface;
use Core\BusinessRules\Auth\ValidateUserPasswordInterface;
use Core\Interactors\Auth\CheckIsUserExistsByLoginAction;
use Core\Interactors\Auth\ClearAccessTokensByUserIdAction;
use Core\Interactors\Auth\CreateUserAction;
use Core\Interactors\Auth\GetAccessTokenByTokenAction;
use Core\Interactors\Auth\GetUserIdByLoginAction;
use Core\Interactors\Auth\LoginUserAction;
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
            GetAccessTokenByTokenInterface::class => autowire(GetAccessTokenByTokenAction::class),
            ClearAccessTokensByUserIdInterface::class => autowire(ClearAccessTokensByUserIdAction::class),
            ValidateUserPasswordInterface::class => autowire(ValidateUserPasswordAction::class)
        ];
    }
}