<?php

declare(strict_types=1);

namespace App;

interface CacheInterface
{
    public function get(string $key): ?string;
    public function set(string $key, string $value): void;
}
