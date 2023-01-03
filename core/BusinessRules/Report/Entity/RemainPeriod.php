<?php

namespace Core\BusinessRules\Report\Entity;

use Core\BusinessRules\Common\Money\Money;
use DateTimeImmutable;

class RemainPeriod
{
    public function __construct(
        private DateTimeImmutable $date,
        private Money $totalPlanned,
        private Money $totalActual
    ) {}

    public function getDate(): DateTimeImmutable
    {
        return $this->date;
    }

    public function getTotalActual(): Money
    {
        return $this->totalActual;
    }

    public function getTotalPlanned(): Money
    {
        return $this->totalPlanned;
    }
}