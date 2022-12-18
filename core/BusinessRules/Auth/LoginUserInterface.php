<?php

namespace Core\BusinessRules\Auth;

interface LoginUserInterface
{
    public function login(int $userId): AccessToken;
}