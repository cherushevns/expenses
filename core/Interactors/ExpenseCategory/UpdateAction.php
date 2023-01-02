<?php

namespace Core\Interactors\ExpenseCategory;

use Core\BusinessRules\ExpenseCategory\Entity\Expense;
use Core\BusinessRules\ExpenseCategory\UpdateInterface;
use Core\Infrastructure\DataAccessors\Database\ExpenseCategory\ExpenseCategoryRepository;
use Core\Interactors\ExpenseCategory\Model\ExpenseCategoryModel;

class UpdateAction implements UpdateInterface
{
    private ExpenseCategoryRepository $expenseRepository;
    private ExpenseCategoryModel $expenseModel;

    public function __construct(
        ExpenseCategoryRepository $expenseRepository,
        ExpenseCategoryModel $expenseModel
    ) {
        $this->expenseRepository = $expenseRepository;
        $this->expenseModel = $expenseModel;
    }

    public function update(Expense $expense): void
    {
        $this->expenseRepository->update(
            $this->expenseModel->toData($expense)
        );
    }
}