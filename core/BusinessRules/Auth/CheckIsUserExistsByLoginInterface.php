<?php

namespace Core\BusinessRules\Auth;

interface CheckIsUserExistsByLoginInterface
{
    public function check(string $login): bool;
}
