<?php

namespace CrixuAMG\PriceCacheWarmer\Templates;

use CrixuAMG\PriceCacheWarmer\Contracts\TemplateDriverContract;

abstract class AbstractTemplateDriver implements TemplateDriverContract
{
    private $target;

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
}
