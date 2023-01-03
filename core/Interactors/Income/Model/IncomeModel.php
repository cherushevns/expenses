<?php

namespace Core\Interactors\Income\Model;

use Core\BusinessRules\Common\Money\Money;
use Core\BusinessRules\Income\Entity\Income;
use Core\Infrastructure\DataAccessors\Database\Income\IncomeEntity;

class IncomeModel
{
    public function toData(Income $income): IncomeEntity
    {
        return new IncomeEntity(
            null,
            $income->getTitle(),
            $income->getUserId(),
            $income->getMoney()->getAmount(),
            $income->getMoney()->getCurrency(),
            $income->getEarnedAt()
        );
    }

    public function toBusiness(IncomeEntity $incomeEntity): Income
    {
        return new Income(
            $incomeEntity->getTitle(),
            new Money(
                $incomeEntity->getAmount(),
                $incomeEntity->getCurrency()
            ),
            $incomeEntity->getEarnedAt(),
            $incomeEntity->getUserId()
        );
    }
}
