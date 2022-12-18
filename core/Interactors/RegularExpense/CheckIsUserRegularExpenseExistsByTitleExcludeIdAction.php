<?php

namespace Core\Interactors\RegularExpense;

use Core\BusinessRules\RegularExpense\CheckIsUserRegularExpenseExistsByTitleExcludeIdInterface;
use Core\Infrastructure\DataAccessors\Database\RegularExpense\RegularExpenseRepository;

class CheckIsUserRegularExpenseExistsByTitleExcludeIdAction implements CheckIsUserRegularExpenseExistsByTitleExcludeIdInterface
{
    private RegularExpenseRepository $regularExpenseRepository;

    public function __construct(
        RegularExpenseRepository $regularExpenseRepository
    ) {
        $this->regularExpenseRepository = $regularExpenseRepository;
    }

    public function check(string $title, int $id, int $userId): bool
    {
        $regularExpenseEntity = $this->regularExpenseRepository->getByTitleAndUserIdExcludeId($title, $id, $userId);

        return ! is_null($regularExpenseEntity);
    }
}