<?php

namespace CrixuAMG\PriceCacheWarmer\Traits;

use BadMethodCallException;
use Closure;

trait Macroable
{
    /**
     * The registered string macros.
     *
     * @var array
     */
    protected static $macros = [];

    /**
     * Register a custom macro.
     *
     * @param  string  $name
     * @param  object|callable  $macro
     * @return void
     */
    public static function macro(string $name, callable $macro)
    {
        static::$macros[$name] = $macro;
    }

    /**
     * Checks if macro is registered.
     *
     * @param  string  $name
     * @return bool
     */
    public static function hasMacro(string $name)
    {
        return isset(static::$macros[$name]);
    }

    /**
     * Dynamically handle calls to the class.
     *
     * @param  string  $method
     * @param  array  $parameters
     * @return mixed
     *
     * @throws \BadMethodCallException
     */
    public static function __callStatic(string $method, array $parameters)
    {
        return static::callMacro($method, $parameters);
    }

    /**
     * Dynamically handle calls to the class.
     *
     * @param  string  $method
     * @param  array  $parameters
     * @return mixed
     *
     * @throws \BadMethodCallException
     */
    public function __call(string $method, array $parameters)
    {
        return static::callMacro($method, $parameters, $this);
    }

    /**
     * Call the macro
     *
     * @param  string  $macroName
     * @param $parameters
     * @param  null  $newThis
     * @return mixed
     */
    protected function callMacro(string $macroName, $parameters, $newThis = null)
    {
        if (!static::hasMacro($macroName)) {
            throw new BadMethodCallException(sprintf(
                'Method %s::%s does not exist.', static::class, $macroName
            ));
        }

        $macro = static::$macros[$macroName];

        if ($macro instanceof Closure) {
            $macro = $macro->bindTo($newThis, static::class);
        }

        return $macro(...$parameters);
    }
}
