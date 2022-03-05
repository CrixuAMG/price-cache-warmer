# php-price-cache-warmer

Turbo boost fetching calculated prices

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

Command for generating migration/db_schema.xml?

```php
    PriceCacheWarmer::create()
        ->withDriver('laravel')
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