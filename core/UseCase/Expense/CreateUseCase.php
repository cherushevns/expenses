<?php

namespace Core\UseCase\Expense;

use Core\BusinessRules\Common\Auth\GetAuthorizedUserIdInterface;
use Core\BusinessRules\Expense\CreateExpenseInterface;
use Core\BusinessRules\Expense\Entity\Expense;

class CreateUseCase
{
    private CreateExpenseInterface $createExpense;
    private GetAuthorizedUserIdInterface $getAuthorizedUserId;

    public function __construct(
        CreateExpenseInterface $createExpense,
        GetAuthorizedUserIdInterface $getAuthorizedUserId
    ) {
        $this->createExpense = $createExpense;
        $this->getAuthorizedUserId = $getAuthorizedUserId;
    }

    public function create(Expense $expense): int
    {
        $expense->setUserId($this->getAuthorizedUserId->get()); // По-идее бы в фабрику утащить, но для MVP и так сойдёт
        return $this->createExpense->create($expense);
    }
}