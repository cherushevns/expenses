<?php

namespace App\RequestValidator\PlannedExpense;

use Core\BusinessRules\ActualExpense;
use Core\BusinessRules\ExpenseCategory;

class DeleteValidator
{
    public function __construct(
        private ActualExpense\GetByIdInterface $actualExpenseGetById,
        private ExpenseCategory\GetByIdInterface $expenseCategoryGetById
    ) {}

    public function validate(int $id): array
    {
        $errors = [];

        $actualExpense = $this->actualExpenseGetById->get($id);

        if (! $actualExpense) {
            $errors[] = ['field' => 'id', 'error' => 'Расход не существует'];
        }

        if (empty($errors) && ! $this->expenseCategoryGetById->get($actualExpense->getCategoryId())) {
            $errors[] = ['field' => 'id', 'error' => 'Расход не существует'];
        }

        return $errors;
    }
}