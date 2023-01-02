<?php

namespace Core\BusinessRules\PlannedExpense;

use Core\BusinessRules\PlannedExpense\Entity\PlannedExpense;

interface CreateInterface
{
    public function create(PlannedExpense $plannedExpense): void;
}