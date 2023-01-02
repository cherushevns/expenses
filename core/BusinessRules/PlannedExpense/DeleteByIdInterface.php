<?php

namespace Core\BusinessRules\PlannedExpense;

interface DeleteByIdInterface
{
    public function delete(int $id): void;
}