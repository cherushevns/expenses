<?php

namespace Core\BusinessRules\Report\Entity;

use Core\BusinessRules\Common\Money\Money;
use DateTimeImmutable;

class RemainPeriod
{
    public function __construct(
        private DateTimeImmutable $date,
        private Money $totalPlanned,
        private Money $totalActual,
        private float $limitPercent
    ) {}

    public function getDate(): DateTimeImmutable
    {
        return $this->date;
    }

    public function getTotalActual(): Money
    {
        return $this->totalActual;
    }

    public function setTotalActual(Money $totalActual): void
    {
        $this->totalActual = $totalActual;
    }

    public function getTotalPlanned(): Money
    {
        return $this->totalPlanned;
    }

    public function setTotalPlanned(Money $totalPlanned): void
    {
        $this->totalPlanned = $totalPlanned;
    }

    public function getLimitPercent(): float
    {
        return $this->limitPercent;
    }

    public function setLimitPercent(float $limitPercent): void
    {
        $this->limitPercent = $limitPercent;
    }
}