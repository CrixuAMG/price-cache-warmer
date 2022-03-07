# php-price-cache-warmer

Turbo boost fetching calculated prices

[![PHP Composer](https://github.com/CrixuAMG/php-price-cache-warmer/actions/workflows/php.yml/badge.svg)](https://github.com/CrixuAMG/php-price-cache-warmer/actions/workflows/php.yml)

- id
- item_type
- item_id
- target_type
- target_id
- price_excl_vat
- price_incl_vat
- price_vat
- valid_until
- created_at
- updated_at

A solution for adding custom columns should be available, such as a Magento 2 store_id or a currency id. These values
should be easy to set, using model hooks or events.

A cron should be available to recalculate values when the price is not valid anymore (valid_until).

Drivers would be a great addition, allowing for a one package solution for Magento 2, Laravel and other types of
repositories. A default could be set, implementing an interface that can be targeted in the DI container of the
application.

- [x] Command for adding migration to the project
- [] Abstract drivers to separate packages
- [] Fully working Laravel implementation
- [] Fully working Magento 2 implementation
- [] Tests for all basic functions, using a dynamic test driver

```php
    PriceCacheWarmer::withDriver('laravel')
        ->setItem($product)
        ->setTarget($user)
        ->cacheIsValidTill(Carbon::now()->addDays(2))
        ->cache(function (PriceCacheWarmer $cacheWarmer) use ($product) {
            $defaultPrice = $product->price;
            $vatPercentage = $product->vatPercentage;
            $vatIsIncluded = $product->vatIncluded;

            // Get price lists and perform logic
            // Perform other queries and checks, like checking quantities

            $cacheWarmer->setPriceIncludingVat($vatIsIncluded ? $defaultPrice : $defaultPrice * $vatPercentage)
                ->setPriceExcludingVat($vatIsIncluded ? $defaultPrice / $vatPercentage : $defaultPrice)
                ->setVatPrice($vatPrice);
        });
```