<?php

namespace Core\BusinessRules\PlannedExpense;

use Core\BusinessRules\PlannedExpense\Entity\PlannedExpense;

interface GetByIdInterface
{
    public function get(int $id): ?PlannedExpense;
}