<?php

namespace Core\BusinessRules\Income;

use Core\BusinessRules\Income\Entity\Income;

interface GetByIdInterface
{
    public function get(int $id): ?Income;
}