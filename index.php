<?php

use App\GetCapitalCacheService;
use App\GetCapitalService;

require_once __DIR__ . '/vendor/autoload.php';

$getCapitalService = new GetCapitalCacheService(new GetCapitalService());
while (true) {
	$country = readline('Enter a country name: ');
	$capital = $getCapitalService->get($country);

	echo "The capital of $country is $capital\n";
}
