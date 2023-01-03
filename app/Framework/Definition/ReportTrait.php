<?php

namespace App\Framework\Definition;

use Core\BusinessRules\Report\BuildInterface;
use Core\Interactors\Report\BuildAction;
use function DI\autowire;

trait ReportTrait
{
    public static function getReport(): array
    {
        return [
            BuildInterface::class => autowire(BuildAction::class)
        ];
    }
}