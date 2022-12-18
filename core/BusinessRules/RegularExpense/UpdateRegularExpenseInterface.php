<?php

namespace Core\BusinessRules\RegularExpense;

interface UpdateRegularExpenseInterface
{
    public function update(RegularExpense $regularExpense): void;
}