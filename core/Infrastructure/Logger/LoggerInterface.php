<?php

namespace Core\Infrastructure\Logger;

interface LoggerInterface
{
    public const DEBUG = 'debug';
    public const INFO = 'info';
    public const NOTICE = 'notice';
    public const WARNING = 'warning';
    public const ERROR = 'error';
    public const CRITICAL = 'critical';
    public const ALERT = 'alert';
    public const EMERGENCY = 'emergency';

    public const LEVELS_TO_RFC = [
        self::DEBUG => 7,
        self::INFO => 6,
        self::NOTICE => 5,
        self::WARNING => 4,
        self::ERROR => 3,
        self::CRITICAL => 2,
        self::ALERT => 1,
        self::EMERGENCY => 0,
    ];

    public static function getInstance(string $logPath): self;

    public function log(string $message, string $level = self::INFO): void;
}