<?php

declare(strict_types=1);

namespace App\Tests;

use App\CacheInterface;
use App\GetCapitalCacheService;
use App\GetCapitalServiceInterface;
use App\InMemoryCache;
use PHPUnit\Framework\TestCase;

final class GetCapitalCacheServiceTest extends TestCase
{
    public function testDelegatesCallToDecoratedService(): void
    {
        $decoratedService = $this->createMock(GetCapitalServiceInterface::class);
        $service = new GetCapitalCacheService(
            $decoratedService,
            new InMemoryCache(),
        );

        $country = 'dummy country';
        $decoratedService
            ->expects($this->once())
            ->method('get')
            ->with($country);

        $service->get($country);
    }

    public function testCachesCapital(): void
    {
        $decoratedService = $this->createStub(GetCapitalServiceInterface::class);
        $cache = $this->createMock(CacheInterface::class);
        $service = new GetCapitalCacheService(
            $decoratedService,
            $cache,
        );

        $country = 'dummy country';
        $capital = 'dummy capital';
        $decoratedService
            ->method('get')
            ->with($country)
            ->willReturn($capital);

        $cache
            ->expects($this->once())
            ->method('set')
            ->with($country, $capital);

        $service->get($country);
    }

    public function testReturnsFromCache(): void
    {
        $decoratedService = $this->createMock(GetCapitalServiceInterface::class);
        $cache = $this->createStub(CacheInterface::class);
        $service = new GetCapitalCacheService(
            $decoratedService,
            $cache,
        );

        $country = 'dummy country';
        $capital = 'dummy capital';
        $cache
            ->method('get')
            ->willReturn($capital);

        $decoratedService
            ->expects($this->never())
            ->method('get')
            ->with($country);

        $service->get($country);
    }
}
