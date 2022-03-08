<?php

namespace CrixuAMG\PriceCacheWarmer;

use CrixuAMG\PriceCacheWarmer\Drivers\DriverManager;

/**
 *
 */
class PriceCacheWarmer
{
    /**
     * @var
     */
    public $driver;

    /**
     * @return PriceCacheWarmer
     */
    public static function getInstance(): PriceCacheWarmer
    {
        return new self;
    }

    /**
     * @param  string  $driver
     * @return PriceCacheWarmer
     * @throws Exceptions\DriverDoesNotExistException
     */
    public static function withDriver(string $driver)
    {
        $instance = self::getInstance();

        $instance->driver = DriverManager::driver($driver);

        return $instance;
    }

    /**
     * @param $name
     * @return mixed
     */
    public function __get($name)
    {
        return $this->driver->$name;
    }

    /**
     * @param $name
     * @param $value
     * @return $this
     */
    public function __set($name, $value)
    {
        $this->driver->$name = $value;

        return $this;
    }

    /**
     * @param $name
     * @param $arguments
     * @return $this|void
     */
    public function __call($name, $arguments)
    {
        if (is_callable([$this->driver, $name])) {
            $this->driver->$name(...$arguments);

            return $this;
        }
    }

    /**
     * @param  callable  $callable
     * @return mixed
     */
    public function cache(callable $callable)
    {
        return $this->driver->cache($this, $callable);
    }
}
