<?php

namespace Core\BusinessRules\Report\Entity;

class TotalExpenses
{
    /**
     * @param TotalExpensePeriod[] $periods
     */
    public function __construct(
        private array $periods
    ) {}

    public function getPeriods(): array
    {
        return $this->periods;
    }
}