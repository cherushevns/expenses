<?php

namespace Core\Interactors\ExpenseCategory;

use Core\BusinessRules\Common\Auth\GetAuthorizedUserIdInterface;
use Core\BusinessRules\ExpenseCategory\Entity\ExpenseCategory;
use Core\BusinessRules\ExpenseCategory\GetByIdInterface;
use Core\Infrastructure\DataAccessors\Database\ExpenseCategory\ExpenseCategoryRepository;
use Core\Interactors\ExpenseCategory\Model\ExpenseCategoryModel;

class GetByIdAction implements GetByIdInterface
{
    public function __construct(
        private GetAuthorizedUserIdInterface $getAuthorizedUserId,
        private ExpenseCategoryRepository $expenseCategoryRepository,
        private ExpenseCategoryModel $expenseCategoryModel
    ) {}

    public function get(int $id): ?ExpenseCategory
    {
        $expenseCategoryEntity = $this->expenseCategoryRepository->getByIdAndUserId(
            $id,
            $this->getAuthorizedUserId->get()
        );

        return $expenseCategoryEntity
            ? $this->expenseCategoryModel->toBusiness($expenseCategoryEntity)
            : null;
    }
}