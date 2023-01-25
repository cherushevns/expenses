<?php

namespace Core\Interactors\PlannedExpense\Model;

use Core\BusinessRules\Common\Money\Money;
use Core\BusinessRules\PlannedExpense\Entity\PlannedExpense;
use Core\Infrastructure\DataAccessors\Database\PlannedExpense\PlannedExpenseEntity;

class PlannedExpenseModel
{
    public function toData(PlannedExpense $plannedExpense): PlannedExpenseEntity
    {
        return new PlannedExpenseEntity(
            null,
            $plannedExpense->getTitle(),
            $plannedExpense->getCategoryId(),
            $plannedExpense->getMoney()->getAmount(),
            $plannedExpense->getMoney()->getCurrency(),
            $plannedExpense->getWillBeSpentAt()
        );
    }

    public function toBusiness(PlannedExpenseEntity $plannedExpenseEntity): PlannedExpense
    {
        return new PlannedExpense(
            $plannedExpenseEntity->getTitle(),
            $plannedExpenseEntity->getCategoryId(),
            new Money(
                $plannedExpenseEntity->getAmount(),
                $plannedExpenseEntity->getCurrency()
            ),
            $plannedExpenseEntity->getWillBeSpentAt()
        );
    }
}