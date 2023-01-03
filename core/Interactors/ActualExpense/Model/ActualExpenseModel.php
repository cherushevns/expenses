<?php

namespace Core\Interactors\ActualExpense\Model;

use Core\BusinessRules\ActualExpense\Entity\ActualExpense;
use Core\BusinessRules\Common\Money\Money;
use Core\Infrastructure\DataAccessors\Database\ActualExpense\ActualExpenseEntity;

class ActualExpenseModel
{
    public function toData(ActualExpense $actualExpense): ActualExpenseEntity
    {
        return new ActualExpenseEntity(
            null,
            $actualExpense->getCategoryId(),
            $actualExpense->getTitle(),
            $actualExpense->getMoney()->getAmount(),
            $actualExpense->getMoney()->getCurrency(),
            $actualExpense->getSpentAt()
        );
    }

    public function toBusiness(ActualExpenseEntity $actualExpenseEntity): ActualExpense
    {
        return new ActualExpense(
            $actualExpenseEntity->getCategoryId(),
            $actualExpenseEntity->getTitle(),
            new Money(
                $actualExpenseEntity->getAmount(),
                $actualExpenseEntity->getCurrency()
            ),
            $actualExpenseEntity->getSpentAt()
        );
    }
}