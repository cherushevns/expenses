<?php

namespace Core\Interactors\RegularExpense\Model;

use Core\BusinessRules\RegularExpense\RegularExpense;
use Core\Infrastructure\DataAccessors\Database\RegularExpense\RegularExpenseEntity;

class RegularExpenseModel
{
    public function toData(RegularExpense $regularExpense): RegularExpenseEntity
    {
        return new RegularExpenseEntity(
            $regularExpense->getId(),
            $regularExpense->getTitle(),
            $regularExpense->getUserId()
        );
    }

    public function toBusiness(RegularExpenseEntity $regularExpenseEntity): RegularExpense
    {
        return new RegularExpense(
            $regularExpenseEntity->getId(),
            $regularExpenseEntity->getTitle(),
            $regularExpenseEntity->getUserId()
        );
    }
}