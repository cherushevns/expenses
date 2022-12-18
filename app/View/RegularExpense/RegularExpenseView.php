<?php

namespace App\View\RegularExpense;

use Core\BusinessRules\RegularExpense\RegularExpense;

class RegularExpenseView
{
    public const ID = 'id';
    public const TITLE = 'title';

    /**
     * @param RegularExpense[] $expenses
     * @return array
     */
    public function fromBusinessToView(array $regularExpenses): array
    {
        return array_map(
            static fn (RegularExpense $regularExpense): array => [
                self::ID => $regularExpense->getId(),
                self::TITLE => $regularExpense->getTitle()
            ],
            $regularExpenses
        );
    }
}