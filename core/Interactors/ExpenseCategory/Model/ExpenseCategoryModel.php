<?php

namespace Core\Interactors\ExpenseCategory\Model;

use Core\BusinessRules\ExpenseCategory\Entity\ExpenseCategory;
use Core\BusinessRules\ExpenseCategory\Entity\Type;
use Core\Infrastructure\DataAccessors\Database\ExpenseCategory\ExpenseCategoryEntity;

class ExpenseCategoryModel
{
    public function toData(ExpenseCategory $expense): ExpenseCategoryEntity
    {
        return new ExpenseCategoryEntity(
            $expense->getId(),
            $expense->getTitle(),
            $expense->getUserId(),
            $expense->getType()
        );
    }

    public function toBusiness(ExpenseCategoryEntity $expenseCategoryEntity): ExpenseCategory
    {
        return new ExpenseCategory(
            $expenseCategoryEntity->getId(),
            $expenseCategoryEntity->getUserId(),
            $expenseCategoryEntity->getTitle(),
            new Type($expenseCategoryEntity->getType())
        );
    }
}