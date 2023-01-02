<?php

namespace App\Framework\Definition;

use Core\BusinessRules\PlannedExpense\CreateInterface;
use Core\BusinessRules\PlannedExpense\DeleteByIdInterface;
use Core\BusinessRules\PlannedExpense\GetExistIdInterface;
use Core\Interactors\PlannedExpense\CreateAction;
use Core\Interactors\PlannedExpense\DeleteByIdIAction;
use Core\Interactors\PlannedExpense\GetExistIdAction;
use function DI\autowire;

trait PlannedExpenseTrait
{
    public static function getPlannedExpense(): array
    {
        return [
            CreateInterface::class => autowire(CreateAction::class),
            DeleteByIdInterface::class => autowire(DeleteByIdIAction::class),
            GetExistIdInterface::class => autowire(GetExistIdAction::class),
        ];
    }
}