<?php

namespace Core\BusinessRules\Report\Entity;

use DateTimeImmutable;

class Report
{
    /**
     * @param DateTimeImmutable[] $periods
     * @param Incomes $incomes
     * @param Remains $remains
     * @param Expenses $expenses
     * @param TotalExpenses $totalExpenses
     */
    public function __construct(
        private array $periods,
        private Incomes $incomes,
        private Remains $remains,
        private Expenses $expenses,
        private TotalExpenses $totalExpenses
    ) {}

    public function getPeriods(): array
    {
        return $this->periods;
    }

    public function getIncomes(): Incomes
    {
        return $this->incomes;
    }

    public function getRemains(): Remains
    {
        return $this->remains;
    }

    public function getExpenses(): Expenses
    {
        return $this->expenses;
    }

    public function getTotalExpenses(): TotalExpenses
    {
        return $this->totalExpenses;
    }
}