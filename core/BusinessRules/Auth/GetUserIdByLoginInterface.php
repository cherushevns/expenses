<?php

namespace Core\BusinessRules\Auth;

interface GetUserIdByLoginInterface
{
    public function get(string $login): int;
}