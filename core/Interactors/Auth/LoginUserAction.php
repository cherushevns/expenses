<?php

namespace Core\Interactors\Auth;

use Core\BusinessRules\Auth\AccessToken;
use Core\BusinessRules\Auth\LoginUserInterface;
use Core\Infrastructure\DataAccessors\Database\AccessToken\AccessTokenRepository;
use Core\Interactors\Auth\Model\AccessTokenModel;

class LoginUserAction implements LoginUserInterface
{
    private AccessTokenRepository $accessTokenRepository;
    private AccessTokenModel $accessTokenModel;

    public function __construct(
        AccessTokenRepository $accessTokenRepository,
        AccessTokenModel $accessTokenModel
    ) {
        $this->accessTokenRepository = $accessTokenRepository;
        $this->accessTokenModel = $accessTokenModel;
    }

    public function login(int $userId): AccessToken
    {
        $accessTokenEntity = $this->accessTokenModel->toDb($userId);
        $this->accessTokenRepository->clearUserTokens($userId);
        $this->accessTokenRepository->save($accessTokenEntity);

        return $this->accessTokenModel->toBusiness($accessTokenEntity);
    }
}