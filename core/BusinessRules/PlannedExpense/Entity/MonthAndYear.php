<?php

namespace Core\BusinessRules\PlannedExpense\Entity;

class MonthAndYear
{
    public function __construct(
        private int $month,
        private int $year
    ) {}

    public function getMonth(): int
    {
        return $this->month;
    }

    public function getYear(): int
    {
        return $this->year;
    }
}