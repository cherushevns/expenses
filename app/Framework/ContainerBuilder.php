<?php

namespace App\Framework;

use App\Framework\Definition;
use DI\Container;
use DI\ContainerBuilder as DIContainerBuilder;

class ContainerBuilder
{
    use Definition\InfrastructureTrait;
    use Definition\AuthTrait;
    use Definition\ExpenseCategoryTrait;
    use Definition\CommonTrait;
    use Definition\PlannedExpense;

    public static function build(): Container
    {
        $containerBuilder = new DIContainerBuilder();

        // @todo impl cache

        $containerBuilder->addDefinitions(self::getInfrastructure());
        $containerBuilder->addDefinitions(self::getCommon());
        $containerBuilder->addDefinitions(self::getAuth());
        $containerBuilder->addDefinitions(self::getExpenseCategory());
        $containerBuilder->addDefinitions(self::getPlannedExpense());

        return $containerBuilder->build();
    }
}