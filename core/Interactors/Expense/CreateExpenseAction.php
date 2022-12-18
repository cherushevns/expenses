<?php

namespace Core\Interactors\Expense;

use Core\BusinessRules\Expense\CreateExpenseInterface;
use Core\BusinessRules\Expense\Entity\Expense;
use Core\Infrastructure\DataAccessors\Database\Expense\ExpenseRepository;
use Core\Interactors\Expense\Model\ExpenseModel;

class CreateExpenseAction implements CreateExpenseInterface
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

    public function create(Expense $expense): int
    {
        return $this->expenseRepository->create(
            $this->expenseModel->toData($expense)
        );
    }
}