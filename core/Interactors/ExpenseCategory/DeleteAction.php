<?php

namespace Core\Interactors\ExpenseCategory;

use Core\BusinessRules\ExpenseCategory\DeleteInterface;
use Core\Infrastructure\DataAccessors\Database\ActualExpense\ActualExpenseRepository;
use Core\Infrastructure\DataAccessors\Database\ExpenseCategory\ExpenseCategoryRepository;
use Core\Infrastructure\DataAccessors\Database\PlannedExpense\PlannedExpenseRepository;

class DeleteAction implements DeleteInterface
{
    public function __construct(
        private ExpenseCategoryRepository $expenseCategoryRepository,
        private ActualExpenseRepository $actualExpenseRepository,
        private PlannedExpenseRepository $plannedExpenseRepository
    ) {}

    public function delete(int $id): void
    {
        $this->expenseCategoryRepository->deleteById($id);
        $this->actualExpenseRepository->deleteByCategoryId($id);
        $this->plannedExpenseRepository->deleteByCategoryId($id);
    }
}