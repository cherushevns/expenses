<?php

namespace Core\Interactors\ExpenseCategory;

use Core\BusinessRules\Common\Auth\GetAuthorizedUserIdInterface;
use Core\BusinessRules\ExpenseCategory\CheckIsExistsInterface;
use Core\BusinessRules\ExpenseCategory\Entity\Expense;
use Core\Infrastructure\DataAccessors\Database\ExpenseCategory\ExpenseCategoryRepository;
use Core\Interactors\ExpenseCategory\Model\ExpenseCategoryModel;

class CheckIsExistsAction implements CheckIsExistsInterface
{
    private ExpenseCategoryRepository $expenseRepository;
    private ExpenseCategoryModel $expenseModel;
    private GetAuthorizedUserIdInterface $getAuthorizedUserId;

    public function __construct(
        ExpenseCategoryRepository    $expenseRepository,
        ExpenseCategoryModel         $expenseModel,
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