<?php

namespace Core\Interactors\ExpenseCategory;

use Core\BusinessRules\Common\Auth\GetAuthorizedUserIdInterface;
use Core\BusinessRules\ExpenseCategory\CheckIsExistsInterface;
use Core\BusinessRules\ExpenseCategory\Entity\ExpenseCategory;
use Core\Infrastructure\DataAccessors\Database\ExpenseCategory\ExpenseCategoryRepository;
use Core\Interactors\ExpenseCategory\Model\ExpenseCategoryModel;

class CheckIsExistsAction implements CheckIsExistsInterface
{
    public function __construct(
        private ExpenseCategoryRepository $expenseCategoryRepository,
        private ExpenseCategoryModel $expenseCategoryModel,
        private GetAuthorizedUserIdInterface $getAuthorizedUserId
    ) {}

    public function check(ExpenseCategory $expense): bool
    {
        $expense->setUserId($this->getAuthorizedUserId->get());

        return $this->expenseCategoryRepository->checkIsExists(
            $this->expenseCategoryModel->toData($expense)
        );
    }
}