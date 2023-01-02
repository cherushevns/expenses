<?php

namespace Core\Infrastructure\Logger;

use Psr\Log\LoggerInterface as PsrLoggerInterface;
use Monolog\Logger as MonologLogger;
use Monolog\Handler\StreamHandler;

class Logger implements LoggerInterface
{
    private static ?self $instance = null;

    private function __construct(
        private PsrLoggerInterface $psrLogger
    ) {
    }

    /**
     * @param string $logPath
     * @return LoggerInterface
     * @description а вот тут мы можем в любой момент переставить Monolog на любой другой PSR-3 логгер,
     * можем даже написать свой :)
     */
    public static function getInstance(string $logPath): LoggerInterface
    {
        if (! self::$instance) {
            $monolog = new MonologLogger('logger');
            $monolog->pushHandler(new StreamHandler($logPath));

            self::$instance = new self($monolog);
        }

        return self::$instance;
    }

    public function log(string $message, string $level = self::INFO): void
    {
        $this->psrLogger->log(self::LEVELS_TO_RFC[$level], $message);
    }
}