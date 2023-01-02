<?php

namespace Core\Interactors\ExpenseCategory;

use Core\BusinessRules\ExpenseCategory\Entity\ExpenseCategory;
use Core\BusinessRules\ExpenseCategory\UpdateInterface;
use Core\Infrastructure\DataAccessors\Database\ExpenseCategory\ExpenseCategoryRepository;
use Core\Interactors\ExpenseCategory\Model\ExpenseCategoryModel;

class UpdateAction implements UpdateInterface
{
    private ExpenseCategoryRepository $expenseCategoryRepository;
    private ExpenseCategoryModel $expenseCategoryModel;

    public function __construct(
        ExpenseCategoryRepository $expenseCategoryRepository,
        ExpenseCategoryModel $expenseCategoryModel
    ) {
        $this->expenseCategoryRepository = $expenseCategoryRepository;
        $this->expenseCategoryModel = $expenseCategoryModel;
    }

    public function update(ExpenseCategory $expense): void
    {
        $this->expenseCategoryRepository->update(
            $this->expenseCategoryModel->toData($expense)
        );
    }
}