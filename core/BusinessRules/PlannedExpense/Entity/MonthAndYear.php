<?php

namespace Core\BusinessRules\PlannedExpense\Entity;

class MonthAndYear
{
    private int $month;
    private int $year;

    public function __construct(
        int $month,
        int $year
    ) {
        $this->month = $month;
        $this->year = $year;
    }

    public function getMonth(): int
    {
        return $this->month;
    }

    public function getYear(): int
    {
        return $this->year;
    }
}