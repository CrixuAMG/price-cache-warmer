<?php

namespace CrixuAMG\PriceCacheWarmer;

use CrixuAMG\PriceCacheWarmer\Contracts\TemplateDriverContract;
use CrixuAMG\PriceCacheWarmer\Templates\TemplateDriverManager;

class PriceCacheWarmer
{
    public $driver;
    public $validUntil;
    public $priceInclVat;
    public $priceExclVat;
    public $vatPrice;

    public static function create()
    {
        return new self;
    }

    public function withDriver(string $driver)
    {
        $this->driver = TemplateDriverManager::driver($driver);

        return $this;
    }

    public function setDriver(TemplateDriverContract $driver)
    {
        $this->driver = $driver;

        return $this;
    }

    public function setItem($item)
    {
        $this->driver->setItem($item);

        return $this;
    }

    public function setTarget($target)
    {
        $this->driver->setTarget($target);

        return $this;
    }

    public function cacheIsValidTill(\DateTime $validUntil = null)
    {
        $this->validUntil = $validUntil;

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

    public function cache(callable $callable)
    {
        return $this->driver->cache($this, $callable);
    }
}
