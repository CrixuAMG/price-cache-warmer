<?php

namespace CrixuAMG\PriceCacheWarmer;

use CrixuAMG\PriceCacheWarmer\Contracts\TemplateDriverContract;
use CrixuAMG\PriceCacheWarmer\Templates\TemplateDriverManager;

class PriceCacheWarmer
{
    public $driver;

    public function __get($name)
    {
        return $this->driver->$name;
    }

    public function __set($name, $value)
    {
        $this->driver->$name = $value;

        return $this;
    }

    public function __call($name, $arguments)
    {
        if (is_callable([$this->driver, $name])) {
            $this->driver->$name(...$arguments);

            return $this;
        }
    }

    public static function withDriver(string $driver)
    {
        $instance = new self;

        $instance->driver = TemplateDriverManager::driver($driver);

        return $instance;
    }

    public function setDriver(TemplateDriverContract $driver)
    {
        $this->driver = $driver;

        return $this;
    }

    public function cache(callable $callable)
    {
        return $this->driver->cache($this, $callable);
    }
}
