<?php

namespace App\RequestValidator\PlannedExpense;

use Core\BusinessRules\PlannedExpense;
use Core\BusinessRules\ExpenseCategory;

class DeleteValidator
{
    public function __construct(
        private PlannedExpense\GetByIdInterface $plannedExpenseGetById,
        private ExpenseCategory\GetByIdInterface $expenseCategoryGetById
    ) {}

    public function validate(int $id): array
    {
        $errors = [];

        $actualExpense = $this->plannedExpenseGetById->get($id);

        if (! $actualExpense) {
            $errors[] = ['field' => 'id', 'error' => 'Расход не существует'];
        }

        if (empty($errors) && ! $this->expenseCategoryGetById->get($actualExpense->getCategoryId())) {
            $errors[] = ['field' => 'id', 'error' => 'Расход не существует'];
        }

        return $errors;
    }
}