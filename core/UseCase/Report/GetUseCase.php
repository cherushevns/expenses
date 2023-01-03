<?php

namespace Core\UseCase\Report;

use Core\BusinessRules\Report\BuildInterface;
use Core\BusinessRules\Report\Entity\Report;
use DateTimeImmutable;

class GetUseCase
{
    public function __construct(
        private BuildInterface $build
    ) {}

    public function get(
        DateTimeImmutable $dateFrom,
        DateTimeImmutable $dateTo,
    ): Report {
        return $this->build->build(
            $dateFrom,
            $dateTo
        );
    }
}