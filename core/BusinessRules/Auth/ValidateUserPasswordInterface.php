<?php

namespace Core\BusinessRules\Auth;

interface ValidateUserPasswordInterface
{
    public function validate(string $login, string $password): bool;
}