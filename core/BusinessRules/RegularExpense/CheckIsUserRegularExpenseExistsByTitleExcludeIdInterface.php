<?php

namespace Core\BusinessRules\RegularExpense;

interface CheckIsUserRegularExpenseExistsByTitleExcludeIdInterface
{
    public function check(string $title, int $id, int $userId): bool;
}