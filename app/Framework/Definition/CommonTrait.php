<?php

namespace App\Framework\Definition;

use Core\BusinessRules\Common\Auth\GetAuthorizedUserIdInterface;
use Core\Interactors\Common\Auth\GetAuthorizedUserIdAction;
use function DI\autowire;

trait CommonTrait
{
    public static function getCommon(): array
    {
        return [
            GetAuthorizedUserIdInterface::class => autowire(GetAuthorizedUserIdAction::class)
        ];
    }
}