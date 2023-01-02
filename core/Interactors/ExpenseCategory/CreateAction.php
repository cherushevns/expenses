<?php

namespace Core\Interactors\ExpenseCategory;

use Core\BusinessRules\Common\Auth\GetAuthorizedUserIdInterface;
use Core\BusinessRules\ExpenseCategory\CreateInterface;
use Core\BusinessRules\ExpenseCategory\Entity\ExpenseCategory;
use Core\Infrastructure\DataAccessors\Database\ExpenseCategory\ExpenseCategoryRepository;
use Core\Interactors\ExpenseCategory\Model\ExpenseCategoryModel;

class CreateAction implements CreateInterface
{
    public function __construct(
        private GetAuthorizedUserIdInterface $getAuthorizedUserId,
        private ExpenseCategoryRepository $expenseCategoryRepository,
        private ExpenseCategoryModel $expenseCategoryModel
    ) {}

    public function create(ExpenseCategory $expense): int
    {
        $expense->setUserId($this->getAuthorizedUserId->get()); // По-идее бы в фабрику утащить, но для MVP и так сойдёт

        return $this->expenseCategoryRepository->create(
            $this->expenseCategoryModel->toData($expense)
        );
    }
}