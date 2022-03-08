<?php

namespace CrixuAMG\PriceCacheWarmer\Drivers;

use CrixuAMG\PriceCacheWarmer\Exceptions\DriverDoesNotExistException;
use CrixuAMG\PriceCacheWarmer\Exceptions\InvalidDriverException;
use CrixuAMG\PriceCacheWarmer\Laravel\LaravelDriver;
use CrixuAMG\PriceCacheWarmer\Traits\Macroable;

class DriverManager
{
    use Macroable;

    public static function driver(string $driver = 'default')
    {
        $driver = preg_replace_callback("/(?:^|_)([a-z])/", function ($matches) {
            return strtoupper($matches[1]);
        }, $driver);
        $methodName = "create{$driver}Driver";
        if (!is_callable([new self, $methodName])) {
            throw new DriverDoesNotExistException("Driver {$driver} does not exist");
        }

        return (new self)->$methodName();
    }

    public function createDefaultDriver()
    {
        throw new InvalidDriverException('Default driver is not available');
    }

    public function createLaravelDriver()
    {
        return new LaravelDriver();
    }

//    public function createMagento2Driver()
//    {
//        return new Magento2Driver();
//    }
}
