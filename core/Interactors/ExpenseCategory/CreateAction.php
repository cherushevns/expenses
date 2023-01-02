<?php

namespace Core\Interactors\ExpenseCategory;

use Core\BusinessRules\ExpenseCategory\CreateInterface;
use Core\BusinessRules\ExpenseCategory\Entity\Expense;
use Core\Infrastructure\DataAccessors\Database\ExpenseCategory\ExpenseCategoryRepository;
use Core\Interactors\ExpenseCategory\Model\ExpenseCategoryModel;

class CreateAction implements CreateInterface
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

    public function create(Expense $expense): int
    {
        return $this->expenseRepository->create(
            $this->expenseModel->toData($expense)
        );
    }
}