<?php

namespace Core\UseCase\Expense;

use Core\BusinessRules\Common\Auth\GetAuthorizedUserIdInterface;
use Core\BusinessRules\Expense\UpdateExpenseInterface;
use Core\BusinessRules\Expense\Entity\Expense;

class UpdateUseCase
{
    private UpdateExpenseInterface $updateExpense;
    private GetAuthorizedUserIdInterface $getAuthorizedUserId;

    public function __construct(
        UpdateExpenseInterface $updateExpense,
        GetAuthorizedUserIdInterface $getAuthorizedUserId
    ) {
        $this->updateExpense = $updateExpense;
        $this->getAuthorizedUserId = $getAuthorizedUserId;
    }

    public function update(Expense $expense): void
    {
        $expense->setUserId($this->getAuthorizedUserId->get()); // По-идее бы в фабрику утащить, но для MVP и так сойдёт
        $this->updateExpense->update($expense);
    }
}