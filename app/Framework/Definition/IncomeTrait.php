<?php

namespace App\Framework\Definition;

use Core\BusinessRules\Income\CreateInterface;
use Core\BusinessRules\Income\DeleteInterface;
use Core\BusinessRules\Income\GetByIdInterface;
use Core\Interactors\Income\CreateAction;
use Core\Interactors\Income\DeleteAction;
use Core\Interactors\Income\GetByIdAction;
use function DI\autowire;

trait IncomeTrait
{
    public static function getIncome(): array
    {
        return [
            CreateInterface::class => autowire(CreateAction::class),
            DeleteInterface::class => autowire(DeleteAction::class),
            GetByIdInterface::class => autowire(GetByIdAction::class)
        ];
    }
}