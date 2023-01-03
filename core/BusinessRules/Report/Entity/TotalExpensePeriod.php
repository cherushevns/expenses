<?php

namespace Core\BusinessRules\Report\Entity;

use Core\BusinessRules\Common\Money\Money;
use DateTimeImmutable;

class TotalExpensePeriod
{
    public function __construct(
        private DateTimeImmutable $date,
        private Money $planned,
        private Money $actual,
        private float $limitPercent
    ) {}

    public function getDate(): DateTimeImmutable
    {
        return $this->date;
    }

    public function getPlanned(): Money
    {
        return $this->planned;
    }

    public function getActual(): Money
    {
        return $this->actual;
    }

    public function getLimitPercent(): float
    {
        return $this->limitPercent;
    }
}