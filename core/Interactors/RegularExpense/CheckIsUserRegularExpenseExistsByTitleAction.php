<?php

namespace Core\Interactors\RegularExpense;

use Core\BusinessRules\RegularExpense\CheckIsUserRegularExpenseExistsByTitleInterface;
use Core\Infrastructure\DataAccessors\Database\RegularExpense\RegularExpenseRepository;

class CheckIsUserRegularExpenseExistsByTitleAction implements CheckIsUserRegularExpenseExistsByTitleInterface
{
    private RegularExpenseRepository $regularExpenseRepository;

    public function __construct(
        RegularExpenseRepository $regularExpenseRepository
    ) {
        $this->regularExpenseRepository = $regularExpenseRepository;
    }

    public function check(string $title, int $userId): bool
    {
        $regularExpenseEntity = $this->regularExpenseRepository->getByTitleAndUserId($title, $userId);

        return ! is_null($regularExpenseEntity);
    }
}