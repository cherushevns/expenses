<?php

namespace Core\Interactors\ExpenseCategory;

use Core\BusinessRules\ExpenseCategory\GetAllInterface;
use Core\BusinessRules\ExpenseCategory\Entity\Expense;
use Core\Infrastructure\DataAccessors\Database\ExpenseCategory\ExpenseCategoryEntity;
use Core\Infrastructure\DataAccessors\Database\ExpenseCategory\ExpenseCategoryRepository;
use Core\Interactors\ExpenseCategory\Model\ExpenseCategoryModel;

class GetAllAction implements GetAllInterface
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

    public function get(int $userId): array
    {
        return array_map(
            fn (ExpenseCategoryEntity $regularExpenseEntity): Expense => $this->expenseModel->toBusiness(
                $regularExpenseEntity
            ),
            $this->expenseRepository->getAllByUser($userId)
        );
    }
}