<?php

namespace Core\Interactors\Auth\Model;

use Core\BusinessRules\Auth\Entity\AccessToken;
use Core\Infrastructure\DataAccessors\Database\AccessToken\AccessTokenEntity;
use Core\Infrastructure\Uuid\UuidGenerator;
use DateInterval;
use DateTimeImmutable;

class AccessTokenModel
{
    public const TTL = 43200;

    private UuidGenerator $uuidGenerator;

    public function __construct(UuidGenerator $uuidGenerator)
    {
        $this->uuidGenerator = $uuidGenerator;
    }

    public function toData(int $userId): AccessTokenEntity
    {
        return new AccessTokenEntity(
            $userId,
            $this->uuidGenerator->generate(),
            (new DateTimeImmutable())->add(new DateInterval('PT' . self::TTL . 'S'))
        );
    }

    public function toBusiness(AccessTokenEntity $accessTokenEntity): AccessToken
    {
        $ttl = $accessTokenEntity->getExpiresAt()->getTimestamp() - (new DateTimeImmutable())->getTimestamp();
        return new AccessToken(
            $accessTokenEntity->getUserId(),
            $accessTokenEntity->getAccessToken(),
            $ttl
        );
    }
}