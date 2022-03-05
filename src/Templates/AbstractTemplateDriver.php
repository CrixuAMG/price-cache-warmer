<?php

namespace CrixuAMG\PriceCacheWarmer\Templates;

use CrixuAMG\PriceCacheWarmer\Contracts\TemplateDriverContract;

abstract class AbstractTemplateDriver implements TemplateDriverContract
{
    public $target;
    public $validUntill;
    public $priceInclVat;
    public $priceExclVat;
    public $vatPrice;

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
}
