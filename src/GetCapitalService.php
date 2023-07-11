<?php

declare(strict_types=1);

namespace App;

final class GetCapitalService implements GetCapitalServiceInterface
{
    private const API_URL = 'https://restcountries.com/v3.1/name/%s';

    public function get(string $country): string
    {
        $response = file_get_contents(sprintf(self::API_URL, $country));
        $decodedResponse = json_decode($response, true);
        $capital = $decodedResponse[0]['capital'][0];

        return $capital;
    }
}
