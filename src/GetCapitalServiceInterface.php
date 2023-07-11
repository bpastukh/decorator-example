<?php

declare(strict_types=1);

namespace App;

interface GetCapitalServiceInterface
{
    public function get(string $country): string;
}
