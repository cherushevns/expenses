<?php

namespace Core\BusinessRules\ActualExpense;

use Core\BusinessRules\ActualExpense\Entity\ActualExpense;

interface CreateInterface
{
    public function create(ActualExpense $actualExpense): void;
}
