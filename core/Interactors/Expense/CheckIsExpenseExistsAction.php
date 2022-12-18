<?php

namespace Core\Interactors\Expense;

use Core\BusinessRules\Common\Auth\GetAuthorizedUserIdInterface;
use Core\BusinessRules\Expense\CheckIsExpenseExistsInterface;
use Core\BusinessRules\Expense\Entity\Expense;
use Core\Infrastructure\DataAccessors\Database\Expense\ExpenseRepository;
use Core\Interactors\Expense\Model\ExpenseModel;

class CheckIsExpenseExistsAction implements CheckIsExpenseExistsInterface
{
    private ExpenseRepository $expenseRepository;
    private ExpenseModel $expenseModel;
    private GetAuthorizedUserIdInterface $getAuthorizedUserId;

    public function __construct(
        ExpenseRepository $expenseRepository,
        ExpenseModel $expenseModel,
        GetAuthorizedUserIdInterface $getAuthorizedUserId
    ) {
        $this->expenseRepository = $expenseRepository;
        $this->expenseModel = $expenseModel;
        $this->getAuthorizedUserId = $getAuthorizedUserId;
    }

    public function check(Expense $expense): bool
    {
        $expense->setUserId($this->getAuthorizedUserId->get());

        return $this->expenseRepository->checkIsExists(
            $this->expenseModel->toData($expense)
        );
    }
}