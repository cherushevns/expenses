<?php

namespace Core\BusinessRules\Income;

use Core\BusinessRules\Income\Entity\Income;

interface CreateInterface
{
    public function create(Income $income): void;
}