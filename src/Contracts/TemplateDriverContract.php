<?php

namespace CrixuAMG\PriceCacheWarmer\Contracts;

use CrixuAMG\PriceCacheWarmer\PriceCacheWarmer;

interface TemplateDriverContract
{
    // TODO: publish migrations/db_schemes, create default cache/other logic methods

    public function cache(PriceCacheWarmer $priceCacheWarmer, callable $callback): void;
}
