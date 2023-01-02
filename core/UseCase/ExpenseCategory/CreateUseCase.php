<?php

namespace Core\UseCase\ExpenseCategory;

use Core\BusinessRules\Common\Auth\GetAuthorizedUserIdInterface;
use Core\BusinessRules\ExpenseCategory\CreateInterface;
use Core\BusinessRules\ExpenseCategory\Entity\Expense;

class CreateUseCase
{
    private CreateInterface $create;
    private GetAuthorizedUserIdInterface $getAuthorizedUserId;

    public function __construct(
        CreateInterface $create,
        GetAuthorizedUserIdInterface $getAuthorizedUserId
    ) {
        $this->create = $create;
        $this->getAuthorizedUserId = $getAuthorizedUserId;
    }

    public function create(Expense $expense): int
    {
        $expense->setUserId($this->getAuthorizedUserId->get()); // По-идее бы в фабрику утащить, но для MVP и так сойдёт
        return $this->create->create($expense);
    }
}