<?php

namespace Core\BusinessRules\Report;

use Core\BusinessRules\Report\Entity\Report;
use DateTimeImmutable;

interface BuildInterface
{
    public function build(
        DateTimeImmutable $dateFrom,
        DateTimeImmutable $dateTo
    ): Report;
}