<?php

namespace Core\Interactors\Expense;

use Core\BusinessRules\Expense\GetExpensesInterface;
use Core\BusinessRules\Expense\Entity\Expense;
use Core\Infrastructure\DataAccessors\Database\Expense\ExpenseEntity;
use Core\Infrastructure\DataAccessors\Database\Expense\ExpenseRepository;
use Core\Interactors\Expense\Model\ExpenseModel;

class GetExpensesAction implements GetExpensesInterface
{
    private ExpenseRepository $expenseRepository;
    private ExpenseModel $expenseModel;

    public function __construct(
        ExpenseRepository $expenseRepository,
        ExpenseModel $expenseModel
    ) {
        $this->expenseRepository = $expenseRepository;
        $this->expenseModel = $expenseModel;
    }

    public function get(int $userId): array
    {
        return array_map(
            fn (ExpenseEntity $regularExpenseEntity): Expense => $this->expenseModel->toBusiness(
                $regularExpenseEntity
            ),
            $this->expenseRepository->getAllByUser($userId)
        );
    }
}