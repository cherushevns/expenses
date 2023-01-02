<?php

namespace Core\Interactors\Auth;

use Core\BusinessRules\Auth\Entity\AccessToken;
use Core\BusinessRules\Auth\LoginUserInterface;
use Core\Infrastructure\DataAccessors\Database\AccessToken\AccessTokenRepository;
use Core\Interactors\Auth\Model\AccessTokenModel;

class LoginUserAction implements LoginUserInterface
{
    public function __construct(
        private AccessTokenRepository $accessTokenRepository,
        private AccessTokenModel $accessTokenModel
    ) {}

    public function login(int $userId): AccessToken
    {
        $accessTokenEntity = $this->accessTokenModel->toData($userId);
        $this->accessTokenRepository->clearUserTokens($userId);
        $this->accessTokenRepository->save($accessTokenEntity);

        return $this->accessTokenModel->toBusiness($accessTokenEntity);
    }
}