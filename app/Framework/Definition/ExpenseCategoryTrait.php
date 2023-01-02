<?php

namespace App\Framework\Definition;

use Core\BusinessRules\ExpenseCategory\CheckIsExistsInterface;
use Core\BusinessRules\ExpenseCategory\CreateInterface;
use Core\BusinessRules\ExpenseCategory\GetByIdInterface;
use Core\BusinessRules\ExpenseCategory\UpdateInterface;
use Core\Interactors\ExpenseCategory\CheckIsExistsAction;
use Core\Interactors\ExpenseCategory\CreateAction;
use Core\Interactors\ExpenseCategory\GetByIdAction;
use Core\Interactors\ExpenseCategory\UpdateAction;
use function DI\autowire;

trait ExpenseCategoryTrait
{
    public static function getExpenseCategory(): array
    {
        return [
            CheckIsExistsInterface::class => autowire(CheckIsExistsAction::class),
            CreateInterface::class => autowire(CreateAction::class),
            UpdateInterface::class => autowire(UpdateAction::class),
            GetByIdInterface::class => autowire(GetByIdAction::class)
        ];
    }
}