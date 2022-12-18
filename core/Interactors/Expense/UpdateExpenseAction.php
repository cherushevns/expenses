<?php

namespace Core\Interactors\Expense;

use Core\BusinessRules\Expense\Entity\Expense;
use Core\BusinessRules\Expense\UpdateExpenseInterface;
use Core\Infrastructure\DataAccessors\Database\Expense\ExpenseRepository;
use Core\Interactors\Expense\Model\ExpenseModel;

class UpdateExpenseAction implements UpdateExpenseInterface
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

    public function update(Expense $expense): void
    {
        $this->expenseRepository->update(
            $this->expenseModel->toData($expense)
        );
    }
}