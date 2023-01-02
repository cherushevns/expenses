<?php

namespace Core\BusinessRules\ExpenseCategory\Entity;

class TypeEnum
{
    public const REGULAR = 1;
    public const ADDITIONAL = 2;
    public const ACCUMULATION = 3;

    public const ALL = [
        self::REGULAR,
        self::ADDITIONAL,
        self::ACCUMULATION
    ];
}