<?php

namespace App\Framework\Definition;

use Core\BusinessRules\Expense\CheckIsExpenseExistsInterface;
use Core\BusinessRules\Expense\CreateExpenseInterface;
use Core\BusinessRules\Expense\GetExpensesInterface;
use Core\BusinessRules\Expense\UpdateExpenseInterface;
use Core\Interactors\Expense\CheckIsExpenseExistsAction;
use Core\Interactors\Expense\CreateExpenseAction;
use Core\Interactors\Expense\GetExpensesAction;
use Core\Interactors\Expense\UpdateExpenseAction;
use function DI\autowire;

trait ExpenseTrait
{
    public static function getExpense(): array
    {
        return [
            CheckIsExpenseExistsInterface::class => autowire(CheckIsExpenseExistsAction::class),
            CreateExpenseInterface::class => autowire(CreateExpenseAction::class),
            UpdateExpenseInterface::class => autowire(UpdateExpenseAction::class),
            GetExpensesInterface::class => autowire(GetExpensesAction::class),
        ];
    }
}