<?php

namespace CrixuAMG\PriceCacheWarmer\Contracts;

use CrixuAMG\PriceCacheWarmer\PriceCacheWarmer;

interface TemplateDriverContract
{
    // TODO: publish migrations/db_schemes, create default cache/other logic methods

    public function cache(PriceCacheWarmer $priceCacheWarmer, callable $callback);

    public function fetchFromCache();

    public function getMigrationName(): string;

    public function getMigrationPath(): string;
}
