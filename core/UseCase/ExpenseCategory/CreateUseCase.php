<?php

namespace Core\UseCase\ExpenseCategory;

use Core\BusinessRules\ExpenseCategory\CreateInterface;
use Core\BusinessRules\ExpenseCategory\Entity\ExpenseCategory;

class CreateUseCase
{
    public function __construct(
        private CreateInterface $create
    ) {}

    public function create(ExpenseCategory $expense): int
    {
        return $this->create->create($expense);
    }
}