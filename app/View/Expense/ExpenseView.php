<?php

namespace App\View\Expense;

use Core\BusinessRules\Expense\Entity\Expense;
use Core\BusinessRules\Expense\Entity\TypeEnum;

class ExpenseView
{
    public const ID = 'id';
    public const TITLE = 'title';
    public const TYPE = 'type';

    public const TYPES_MAP = [
        TypeEnum::REGULAR => 'Регулярный расход',
        TypeEnum::ADDITIONAL => 'Дополнительный расход',
        TypeEnum::ACCUMULATION => 'Накопление'
    ];

    /**
     * @param Expense[] $expenses
     * @return array
     */
    public function fromBusinessToView(array $expenses): array
    {
        return array_map(
            static fn (Expense $expense): array => [
                self::ID => $expense->getId(),
                self::TITLE => $expense->getTitle(),
                self::TYPE => self::TYPES_MAP[$expense->getType()]
            ],
            $expenses
        );
    }
}