<?php

namespace Core\BusinessRules\RegularExpense;

interface CreateRegularExpenseInterface
{
    public function create(RegularExpense $regularExpense): int;
}