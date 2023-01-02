<?php

namespace Core\BusinessRules\ActualExpense;

use Core\BusinessRules\ActualExpense\Entity\ActualExpense;

interface GetByIdInterface
{
    public function get(int $id): ?ActualExpense;
}