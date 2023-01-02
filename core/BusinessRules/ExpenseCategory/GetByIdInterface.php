<?php

namespace Core\BusinessRules\ExpenseCategory;

use Core\BusinessRules\ExpenseCategory\Entity\ExpenseCategory;

interface GetByIdInterface
{
    public function get(int $id): ?ExpenseCategory;
}