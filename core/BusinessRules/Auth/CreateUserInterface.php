<?php

namespace Core\BusinessRules\Auth;

interface CreateUserInterface
{
    public function create(UserCreateRequest $userCreateRequest): int;
}