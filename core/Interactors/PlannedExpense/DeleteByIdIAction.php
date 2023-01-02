<?php

namespace Core\Interactors\PlannedExpense;

use Core\BusinessRules\PlannedExpense\DeleteByIdInterface;
use Core\Infrastructure\DataAccessors\Database\PlannedExpense\PlannedExpenseRepository;

class DeleteByIdIAction implements DeleteByIdInterface
{
    public function __construct(
        private PlannedExpenseRepository $plannedExpenseRepository
    ) {}

    public function delete(int $id): void
    {
        $this->plannedExpenseRepository->deleteById($id);
    }
}