<?php

namespace Core\Interactors\Auth;

use Core\BusinessRules\Auth\AccessToken;
use Core\BusinessRules\Auth\GetAccessTokenByTokenInterface;
use Core\Infrastructure\DataAccessors\Database\AccessToken\AccessTokenRepository;
use Core\Interactors\Auth\Model\AccessTokenModel;

class GetAccessTokenByTokenAction implements GetAccessTokenByTokenInterface
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

    public function get(string $token): ?AccessToken
    {
        $accessTokenEntity = $this->accessTokenRepository->getByToken($token);

        return $accessTokenEntity ? $this->accessTokenModel->toBusiness($accessTokenEntity) : null;
    }
}