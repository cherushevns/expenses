<?php

namespace Core\BusinessRules\Auth;

use Core\BusinessRules\Auth\Entity\AccessToken;

interface LoginUserInterface
{
    public function login(int $userId): AccessToken;
}