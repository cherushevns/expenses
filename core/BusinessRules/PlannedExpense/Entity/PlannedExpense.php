<?php

namespace Core\BusinessRules\PlannedExpense\Entity;

use Core\BusinessRules\Common\Money\Money;

/**
 * @description Регулярный планируемый расход по категории
 * Привязывается к категории, к году и к месяцу
 */
class PlannedExpense
{
    private int $categoryId;
    private Money $money;
    private ?MonthAndYear $monthAndYear;

    public function __construct(
        int $categoryId,
        Money $money,
        ?MonthAndYear $monthAndYear
    ) {
        $this->categoryId = $categoryId;
        $this->money = $money;
        $this->monthAndYear = $monthAndYear;
    }

    public function getCategoryId(): int
    {
        return $this->categoryId;
    }

    public function getMoney(): Money
    {
        return $this->money;
    }

    public function getMonthAndYear(): ?MonthAndYear
    {
        return $this->monthAndYear;
    }
}