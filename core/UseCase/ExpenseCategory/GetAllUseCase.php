<?php

namespace Core\UseCase\ExpenseCategory;

use Core\BusinessRules\Common\Auth\GetAuthorizedUserIdInterface;
use Core\BusinessRules\ExpenseCategory\GetAllInterface;
use Core\BusinessRules\ExpenseCategory\Entity\Expense;

class GetAllUseCase
{
    private GetAuthorizedUserIdInterface $getAuthorizedUserId;
    private GetAllInterface $getAll;

    public function __construct(
        GetAuthorizedUserIdInterface $getAuthorizedUserId,
        GetAllInterface $getAll
    ) {
        $this->getAuthorizedUserId = $getAuthorizedUserId;
        $this->getAll = $getAll;
    }

    /**
     * @return Expense[]
     */
    public function get(): array
    {
        return $this->getAll->get(
            $this->getAuthorizedUserId->get()
        );
    }
}