<?php

namespace App\Framework\Definition;

use Core\BusinessRules\ActualExpense\CreateInterface;
use Core\BusinessRules\ActualExpense\DeleteInterface;
use Core\BusinessRules\ActualExpense\GetByIdInterface;
use Core\Interactors\ActualExpense\CreateAction;
use Core\Interactors\ActualExpense\DeleteAction;
use Core\Interactors\ActualExpense\GetByIdAction;
use function DI\autowire;

trait ActualExpense
{
    public static function getActualExpense(): array
    {
        return [
            CreateInterface::class => autowire(CreateAction::class),
            DeleteInterface::class => autowire(DeleteAction::class),
            GetByIdInterface::class => autowire(GetByIdAction::class)
        ];
    }
}