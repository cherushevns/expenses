<?php

namespace Core\Interactors\Expense\Model;

use Core\BusinessRules\Expense\Entity\Expense;
use Core\BusinessRules\Expense\Entity\Type;
use Core\Infrastructure\DataAccessors\Database\Expense\ExpenseEntity;

class ExpenseModel
{
    public function toData(Expense $expense): ExpenseEntity
    {
        return new ExpenseEntity(
            $expense->getId(),
            $expense->getTitle(),
            $expense->getUserId(),
            $expense->getType()
        );
    }

    public function toBusiness(ExpenseEntity $regularExpenseEntity): Expense
    {
        return new Expense(
            $regularExpenseEntity->getId(),
            $regularExpenseEntity->getUserId(),
            $regularExpenseEntity->getTitle(),
            new Type($regularExpenseEntity->getType())
        );
    }
}