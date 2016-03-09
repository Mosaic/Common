<?php

namespace Mosaic\Common\Components;

use Interop\Container\Definition\DefinitionProviderInterface;

interface Component
{
    /**
     * @return DefinitionProviderInterface[]
     */
    public function getProviders() : array;

    /**
     * @param string   $name
     * @param callable $callback
     */
    public static function extend(string $name, callable $callback);
}
