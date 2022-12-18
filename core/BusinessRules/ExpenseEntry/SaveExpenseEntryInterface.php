<?php

namespace Core\BusinessRules\ExpenseEntry;

interface SaveExpenseEntryInterface
{
    public function save(): int;
}