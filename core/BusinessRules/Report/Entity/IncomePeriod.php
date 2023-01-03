<?php

namespace Core\BusinessRules\Report\Entity;

use Core\BusinessRules\Common\Money\Money;
use DateTimeImmutable;

class IncomePeriod
{
    /**
     * @param DateTimeImmutable $date
     * @param Money $total
     * @param IncomeEntry[] $entries
     */
    public function __construct(
        private DateTimeImmutable $date,
        private Money $total,
        private array $entries
    ) {}

    public function getDate(): DateTimeImmutable
    {
        return $this->date;
    }

    public function getTotal(): Money
    {
        return $this->total;
    }

    public function getEntries(): array
    {
        return $this->entries;
    }
}