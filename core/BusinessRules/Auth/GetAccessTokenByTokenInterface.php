<?php

namespace Core\BusinessRules\Auth;

interface GetAccessTokenByTokenInterface
{
    public function get(string $token): ?AccessToken;
}