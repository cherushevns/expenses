<?php

namespace Core\BusinessRules\ActualExpense;

interface DeleteInterface
{
    public function delete(int $id): void;
}