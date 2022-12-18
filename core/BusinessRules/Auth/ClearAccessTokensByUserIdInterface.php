<?php

namespace Core\BusinessRules\Auth;

interface ClearAccessTokensByUserIdInterface
{
    public function clear(int $userId): void;
}
