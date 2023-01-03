<?php

namespace Core\BusinessRules\Report\Entity;

class Remains
{
    /**
     * @param RemainPeriod[] $periods
     */
    public function __construct(
        private array $periods
    ) {}

    public function getPeriods(): array
    {
        return $this->periods;
    }
}