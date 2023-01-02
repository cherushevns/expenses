<?php

namespace Core\Interactors\ExpenseCategory\Model;

use Core\BusinessRules\ExpenseCategory\Entity\Expense;
use Core\BusinessRules\ExpenseCategory\Entity\Type;
use Core\Infrastructure\DataAccessors\Database\ExpenseCategory\ExpenseCategoryEntity;

class ExpenseCategoryModel
{
    public function toData(Expense $expense): ExpenseCategoryEntity
    {
        return new ExpenseCategoryEntity(
            $expense->getId(),
            $expense->getTitle(),
            $expense->getUserId(),
            $expense->getType()
        );
    }

    public function toBusiness(ExpenseCategoryEntity $regularExpenseEntity): Expense
    {
        return new Expense(
            $regularExpenseEntity->getId(),
            $regularExpenseEntity->getUserId(),
            $regularExpenseEntity->getTitle(),
            new Type($regularExpenseEntity->getType())
        );
    }
}