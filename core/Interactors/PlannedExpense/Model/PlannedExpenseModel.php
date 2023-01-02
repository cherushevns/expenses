<?php

namespace Core\Interactors\PlannedExpense\Model;

use Core\BusinessRules\Common\Money\Money;
use Core\BusinessRules\PlannedExpense\Entity\MonthAndYear;
use Core\BusinessRules\PlannedExpense\Entity\PlannedExpense;
use Core\Infrastructure\DataAccessors\Database\PlannedExpense\PlannedExpenseEntity;
use DateTimeImmutable;

class PlannedExpenseModel
{
    public function toData(PlannedExpense $plannedExpense): PlannedExpenseEntity
    {
        return new PlannedExpenseEntity(
            $plannedExpense->getCategoryId(),
            $plannedExpense->getMoney()->getAmount(),
            $plannedExpense->getMoney()->getCurrency(),
            $plannedExpense->getWillBeSpentAt()
        );
    }

    public function toBusiness(PlannedExpenseEntity $plannedExpenseEntity): PlannedExpense
    {
        return new PlannedExpense(
            $plannedExpenseEntity->getCategoryId(),
            new Money(
                $plannedExpenseEntity->getAmount(),
                $plannedExpenseEntity->getCurrency()
            ),
            $plannedExpenseEntity->getWillBeSpentAt()
        );
    }

    public function makeDateTimeFromMonthAndYear(MonthAndYear $monthAndYear): DateTimeImmutable
    {
        return new DateTimeImmutable(
            implode(
                '', [
                    '01-',
                    $monthAndYear->getMonth(),
                    '-',
                    $monthAndYear->getYear(),
                    ' 00:00:00'
                ]
            )
        );
    }
}