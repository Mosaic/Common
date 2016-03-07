<?php

namespace Mosaic\Common\Components;

use InvalidArgumentException;

abstract class AbstractComponent implements Component
{
    /**
     * @var string
     */
    protected $implementation;

    /**
     * @var array
     */
    protected static $custom = [];

    /**
     * @return string
     */
    public function getImplementation()
    {
        return $this->implementation;
    }

    /**
     * @param string $implementation
     */
    public function setImplementation(string $implementation)
    {
        $this->implementation = $implementation;
    }

    /**
     * @return array
     */
    public function getDefinitions() : array
    {
        $method = 'resolve' . ucfirst($this->getImplementation());

        if (isset(static::$custom[$this->getImplementation()])) {
            return $this->resolveCustom(static::$custom[$this->getImplementation()]);
        }

        if (method_exists($this, $method)) {
            return call_user_func([$this, $method]);
        }

        return [];
    }

    /**
     * @param  callable $callback
     * @return array
     */
    abstract public function resolveCustom(callable $callback) : array;

    /**
     * @param string   $name
     * @param callable $callback
     */
    public static function extend(string $name, callable $callback)
    {
        static::$custom[$name] = $callback;
    }

    /**
     * @param  string    $name
     * @param  array     $arguments
     * @return Component
     */
    public static function __callStatic(string $name, array $arguments = []) : Component
    {
        if (!static::hasImplementation($name)) {
            throw new InvalidArgumentException('Implementation [' . $name . '] does not exist');
        }

        return new static($name, ...$arguments);
    }

    /**
     * @param $name
     * @return bool
     */
    protected static function hasImplementation($name) : bool
    {
        return isset(static::$custom[$name]) || method_exists(get_called_class(), 'resolve' . ucfirst($name));
    }
}
