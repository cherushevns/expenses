<?php

namespace Core\BusinessRules\Auth;

use Core\BusinessRules\Auth\Entity\UserCreateRequest;

interface CreateUserInterface
{
    public function create(UserCreateRequest $userCreateRequest): int;
}