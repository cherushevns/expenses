<?php

namespace Core\BusinessRules\Common\Money;

class Money
{
    public function __construct(
        private float $amount,
        private string $currency
    ) {}

    public function getAmount(): float
    {
        return $this->amount;
    }

    public function getCurrency(): string
    {
        return $this->currency;
    }
}