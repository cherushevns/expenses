<?php

namespace Core\BusinessRules\Report\Entity;

use Core\BusinessRules\Common\Money\Money;
use DateTimeImmutable;

class ExpensePeriod
{
    /**
     * @param DateTimeImmutable $date
     * @param Money $totalPlanned
     * @param Money $totalActual
     * @param float $limitPercent
     * @param PlannedExpense[] $plannedExpenses
     * @param ActualExpense[] $actualExpenses
     */
    public function __construct(
        private DateTimeImmutable $date,
        private Money $totalPlanned,
        private Money $totalActual,
        private float $limitPercent,
        private array $plannedExpenses,
        private array $actualExpenses
    ) {}

    public function getDate(): DateTimeImmutable
    {
        return $this->date;
    }

    public function getTotalPlanned(): Money
    {
        return $this->totalPlanned;
    }

    public function getTotalActual(): Money
    {
        return $this->totalActual;
    }

    public function getLimitPercent(): float
    {
        return $this->limitPercent;
    }

    public function getPlannedExpenses(): array
    {
        return $this->plannedExpenses;
    }

    public function getActualExpenses(): array
    {
        return $this->actualExpenses;
    }
}