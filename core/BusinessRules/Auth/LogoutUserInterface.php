<?php

namespace Core\BusinessRules\Auth;

interface LogoutUserInterface
{
    public function logout(int $userId): void;
}