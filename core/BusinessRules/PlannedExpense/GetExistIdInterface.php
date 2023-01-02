<?php

namespace Core\BusinessRules\PlannedExpense;

use Core\BusinessRules\PlannedExpense\Entity\PlannedExpense;

interface GetExistIdInterface
{
    public function get(PlannedExpense $plannedExpense): ?int;
}