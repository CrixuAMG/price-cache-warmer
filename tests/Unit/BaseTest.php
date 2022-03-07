<?php

namespace CrixuAMG\PriceCacheWarmer\Test\Unit;

use Carbon\Carbon;
use CrixuAMG\PriceCacheWarmer\PriceCacheWarmer;
use CrixuAMG\PriceCacheWarmer\Templates\AbstractTemplateDriver;
use CrixuAMG\PriceCacheWarmer\Test\TestCase;

class BaseTest extends TestCase
{
    /** @test */
    public function a_driver_can_be_selected()
    {
        $driver = PriceCacheWarmer::withDriver('test')->driver;

        $this->assertInstanceOf(AbstractTemplateDriver::class, $driver);
    }

    /** @test */
    public function a_property_can_be_set_on_the_driver()
    {
        $date = Carbon::now()->addMonths(2);
        $priceCacheWarmer = PriceCacheWarmer::withDriver('test')
            ->cacheIsValidTill($date);

        $this->assertInstanceOf(Carbon::class, $priceCacheWarmer->validUntill);
    }

    /** @test */
    public function a_property_can_be_set_directly_on_the_driver()
    {
        $date = Carbon::now()->addMonths(2);
        $priceCacheWarmer = PriceCacheWarmer::withDriver('test');

        $priceCacheWarmer->validUntill = $date;

        $this->assertInstanceOf(Carbon::class, $priceCacheWarmer->validUntill);
    }
}
