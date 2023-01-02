<?php

namespace Core\UseCase\ExpenseCategory;

use Core\BusinessRules\Common\Auth\GetAuthorizedUserIdInterface;
use Core\BusinessRules\ExpenseCategory\UpdateInterface;
use Core\BusinessRules\ExpenseCategory\Entity\ExpenseCategory;

class UpdateUseCase
{
    private UpdateInterface $update;
    private GetAuthorizedUserIdInterface $getAuthorizedUserId;

    public function __construct(
        UpdateInterface $update,
        GetAuthorizedUserIdInterface $getAuthorizedUserId
    ) {
        $this->update = $update;
        $this->getAuthorizedUserId = $getAuthorizedUserId;
    }

    public function update(ExpenseCategory $expense): void
    {
        $expense->setUserId($this->getAuthorizedUserId->get()); // По-идее бы в фабрику утащить, но для MVP и так сойдёт
        $this->update->update($expense);
    }
}