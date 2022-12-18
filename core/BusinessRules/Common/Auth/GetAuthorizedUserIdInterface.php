<?php

namespace Core\BusinessRules\Common\Auth;

interface GetAuthorizedUserIdInterface
{
    public function get(): int;
}