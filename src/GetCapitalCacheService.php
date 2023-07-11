<?php

declare(strict_types=1);

namespace App;

final class GetCapitalCacheService implements GetCapitalServiceInterface
{
	private GetCapitalServiceInterface $inner;

	private array $cache = [];

	public function __construct(GetCapitalServiceInterface $inner)
	{
		$this->inner = $inner;
	}

	public function get(string $country): string
	{
		if (array_key_exists($country, $this->cache)) {
			echo 'Response using cache: ';
			return $this->cache[$country];
		}

		$capital = $this->inner->get($country);
		$this->cache[$country] = $capital;

		return $capital;
	}
}
