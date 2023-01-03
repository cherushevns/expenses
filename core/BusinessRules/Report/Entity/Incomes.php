<?php

namespace Core\BusinessRules\Report\Entity;

class Incomes
{
    /**
     * @param IncomePeriod[] $periods
     */
    public function __construct(
        private array $periods
    ) {}

    public function getPeriods(): array
    {
        return $this->periods;
    }
}