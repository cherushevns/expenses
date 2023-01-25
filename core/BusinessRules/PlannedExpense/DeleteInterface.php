<?php

namespace Core\BusinessRules\PlannedExpense;

interface DeleteInterface
{
    public function delete(int $id): void;
}