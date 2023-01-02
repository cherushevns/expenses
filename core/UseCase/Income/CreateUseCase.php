<?php

namespace Core\UseCase\Income;

use Core\BusinessRules\Income\CreateInterface;
use Core\BusinessRules\Income\Entity\Income;

class CreateUseCase
{
    public function __construct(
        private CreateInterface $create
    ) {}

    public function create(Income $income): void
    {
        $this->create->create($income);
    }
}