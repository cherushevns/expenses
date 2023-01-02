<?php

namespace Core\Interactors\ExpenseCategory;

use Core\BusinessRules\Common\Auth\GetAuthorizedUserIdInterface;
use Core\BusinessRules\ExpenseCategory\Entity\ExpenseCategory;
use Core\BusinessRules\ExpenseCategory\UpdateInterface;
use Core\Infrastructure\DataAccessors\Database\ExpenseCategory\ExpenseCategoryRepository;
use Core\Interactors\ExpenseCategory\Model\ExpenseCategoryModel;

class UpdateAction implements UpdateInterface
{
    public function __construct(
        private GetAuthorizedUserIdInterface $getAuthorizedUserId,
        private ExpenseCategoryRepository $expenseCategoryRepository,
        private ExpenseCategoryModel $expenseCategoryModel
    ) {}

    public function update(ExpenseCategory $expenseCategory): void
    {
        $expenseCategory->setUserId($this->getAuthorizedUserId->get()); // По-идее бы в фабрику утащить, но для MVP и так сойдёт

        $this->expenseCategoryRepository->update(
            $this->expenseCategoryModel->toData($expenseCategory)
        );
    }
}