<?php

declare(strict_types=1);

namespace App;

final class GetCapitalCacheService implements GetCapitalServiceInterface
{
    public function __construct(
        private readonly GetCapitalServiceInterface $inner,
        private readonly CacheInterface $cache
    ) {
    }

    public function get(string $country): string
    {
        $capital = $this->cache->get($country);
        if (null !== $capital) {
            return $capital;
        }

        $capital = $this->inner->get($country);

        $this->cache->set($country, $capital);

        return $capital;
    }
}
