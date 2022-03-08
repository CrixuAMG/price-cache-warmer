<?php

namespace CrixuAMG\PriceCacheWarmer\Drivers;

use Carbon\Carbon;
use CrixuAMG\PriceCacheWarmer\Contracts\TemplateDriverContract;
use CrixuAMG\PriceCacheWarmer\PriceCacheWarmer;
use Illuminate\Support\Str;

abstract class AbstractDriver implements TemplateDriverContract
{
    public $target;
    public $item;
    public $validUntill;
    public $priceInclVat;
    public $priceExclVat;
    public $vatPrice;
    public $customData;
    protected $driverPath;

    public function __get($name)
    {
        if (isset($this->customData[$name])) {
            return $this->customData[$name];
        }

        return null;
    }

    public function __set($name, $value)
    {
        if (!is_array($this->customData)) {
            $this->customData = [];
        }

        $this->customData[$name] = is_array($value) && count($value) > 1 ? $value : reset($value);

        return $this;
    }

    public function __call($name, $arguments)
    {
        if (stripos($name, 'set') !== false) {
            $paramName = Str::camel(Str::after($name, 'set'));

            $this->$paramName = $arguments;
        }

        if (stripos($name, 'get') !== false) {
            $paramName = Str::camel(Str::after($name, 'get'));

            return $this->$paramName;
        }
    }

    public function cache(PriceCacheWarmer $priceCacheWarmer, callable $callback)
    {
        $cachedData = $this->fetchFromCache();

        dd($cachedData);
        if ($cachedData && $cachedData->validUntill >= Carbon::now()) {
            return $cachedData;
        }

        $result = call_user_func($callback, $priceCacheWarmer);

        $this->driver->insertIntoCache($result);

        return $result;
    }

    public function setTarget($target)
    {
        $this->target = $target;

        return $this;
    }

    public function setItem($item)
    {
        $this->item = $item;

        return $this;
    }

    public function cacheIsValidTill(\DateTime $validUntill = null)
    {
        $this->validUntill = $validUntill;

        return $this;
    }

    public function setPriceIncludingVat($price)
    {
        $this->priceInclVat = $price;

        return $this;
    }

    public function setPriceExcludingVat($price)
    {
        $this->priceExclVat = $price;

        return $this;
    }

    public function setVatPrice($price)
    {
        $this->vatPrice = $price;

        return $this;
    }

    public function getMigrationPath(): string
    {
        return sprintf("%s/%s/Publishes/migration", __DIR__, $this->driverPath);
    }
}
