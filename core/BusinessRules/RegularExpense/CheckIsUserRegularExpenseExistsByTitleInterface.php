<?php

namespace Core\BusinessRules\RegularExpense;

interface CheckIsUserRegularExpenseExistsByTitleInterface
{
    public function check(string $title, int $userId): bool;
}