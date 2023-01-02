<?php

namespace Core\UseCase\ActualExpense;

use Core\BusinessRules\ActualExpense\CreateInterface;
use Core\BusinessRules\ActualExpense\Entity\ActualExpense;

class CreateUseCase
{
    public function __construct(
        private CreateInterface $create
    ) {}

    public function create(ActualExpense $actualExpense): void
    {
        $this->create->create($actualExpense);
    }
}