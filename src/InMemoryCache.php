<?php

declare(strict_types=1);

namespace App;

final class InMemoryCache implements CacheInterface
{
    private array $cache = [];

    
    public function get(string $key): ?string
    {
        return $this->cache[$key] ?? null;
    }

    public function set(string $key, string $value): void
    {
        $this->cache[$key] = $value;
    }
}
