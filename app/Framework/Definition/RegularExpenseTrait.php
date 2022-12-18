<?php

namespace App\Framework\Definition;

use Core\BusinessRules\RegularExpense\CheckIsUserRegularExpenseExistsByTitleExcludeIdInterface;
use Core\BusinessRules\RegularExpense\CheckIsUserRegularExpenseExistsByTitleInterface;
use Core\BusinessRules\RegularExpense\CreateRegularExpenseInterface;
use Core\BusinessRules\RegularExpense\GetRegularExpensesInterface;
use Core\BusinessRules\RegularExpense\UpdateRegularExpenseInterface;
use Core\Interactors\RegularExpense\CheckIsUserRegularExpenseExistsByTitleAction;
use Core\Interactors\RegularExpense\CheckIsUserRegularExpenseExistsByTitleExcludeIdAction;
use Core\Interactors\RegularExpense\CreateRegularExpenseAction;
use Core\Interactors\RegularExpense\GetRegularExpensesAction;
use Core\Interactors\RegularExpense\UpdateRegularExpenseAction;
use function DI\autowire;

trait RegularExpenseTrait
{
    public static function getRegularExpense(): array
    {
        return [
            CheckIsUserRegularExpenseExistsByTitleInterface::class => autowire(CheckIsUserRegularExpenseExistsByTitleAction::class),
            CheckIsUserRegularExpenseExistsByTitleExcludeIdInterface::class => autowire(CheckIsUserRegularExpenseExistsByTitleExcludeIdAction::class),
            CreateRegularExpenseInterface::class => autowire(CreateRegularExpenseAction::class),
            UpdateRegularExpenseInterface::class => autowire(UpdateRegularExpenseAction::class),
            GetRegularExpensesInterface::class => autowire(GetRegularExpensesAction::class),
        ];
    }
}