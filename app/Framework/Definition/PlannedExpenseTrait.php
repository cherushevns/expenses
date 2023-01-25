<?php

namespace App\Framework\Definition;

use Core\BusinessRules\PlannedExpense\CreateInterface;
use Core\BusinessRules\PlannedExpense\DeleteInterface;
use Core\BusinessRules\PlannedExpense\GetByIdInterface;
use Core\BusinessRules\PlannedExpense\GetExistIdInterface;
use Core\Interactors\PlannedExpense\CreateAction;
use Core\Interactors\PlannedExpense\DeleteAction;
use Core\Interactors\PlannedExpense\GetByIdAction;
use Core\Interactors\PlannedExpense\GetExistIdAction;
use function DI\autowire;

trait PlannedExpenseTrait
{
    public static function getPlannedExpense(): array
    {
        return [
            CreateInterface::class => autowire(CreateAction::class),
            DeleteInterface::class => autowire(DeleteAction::class),
            GetExistIdInterface::class => autowire(GetExistIdAction::class),
            GetByIdInterface::class => autowire(GetByIdAction::class),
        ];
    }
}