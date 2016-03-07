<?php

namespace Mosaic\Common\Components;

interface Component
{
    /**
     * @return array
     */
    public function getDefinitions() : array;

    /**
     * @param string   $name
     * @param callable $callback
     */
    public static function extend(string $name, callable $callback);
}
