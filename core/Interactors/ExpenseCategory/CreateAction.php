<?php

namespace Core\Interactors\ExpenseCategory;

use Core\BusinessRules\ExpenseCategory\CreateInterface;
use Core\BusinessRules\ExpenseCategory\Entity\ExpenseCategory;
use Core\Infrastructure\DataAccessors\Database\ExpenseCategory\ExpenseCategoryRepository;
use Core\Interactors\ExpenseCategory\Model\ExpenseCategoryModel;

class CreateAction implements CreateInterface
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

    public function create(ExpenseCategory $expense): int
    {
        return $this->expenseCategoryRepository->create(
            $this->expenseCategoryModel->toData($expense)
        );
    }
}