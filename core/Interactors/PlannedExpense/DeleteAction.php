<?php

namespace Core\Interactors\PlannedExpense;

use Core\BusinessRules\PlannedExpense\DeleteInterface;
use Core\Infrastructure\DataAccessors\Database\PlannedExpense\PlannedExpenseRepository;

class DeleteAction implements DeleteInterface
{
    public function __construct(
        private PlannedExpenseRepository $plannedExpenseRepository
    ) {}

    public function delete(int $id): void
    {
        $this->plannedExpenseRepository->deleteById($id);
    }
}