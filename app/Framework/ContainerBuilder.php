<?php

namespace App\Framework;

use App\Framework\Definition\InfrastructureTrait;
use App\Framework\Definition\AuthTrait;
use App\Framework\Definition\RegularExpenseTrait;
use DI\Container;
use DI\ContainerBuilder as DIContainerBuilder;

class ContainerBuilder
{
    use InfrastructureTrait;
    use AuthTrait;
    use RegularExpenseTrait;

    public static function build(): Container
    {
        $containerBuilder = new DIContainerBuilder();

        // @todo impl cache

        $containerBuilder->addDefinitions(self::getInfrastructure());
        $containerBuilder->addDefinitions(self::getAuth());
        $containerBuilder->addDefinitions(self::getRegularExpense());

        return $containerBuilder->build();
    }
}