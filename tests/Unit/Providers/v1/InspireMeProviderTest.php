<?php

namespace Tests\Unit\Providers\v1;

use Tests\TestCase;
use App\Providers\v1\InspireMeProvider;
use App\Services\v1\QuotesService;
use App\Services\v1\QuoteesService;
use App\Services\v1\NationalitiesService;
use App\Services\v1\ProfessionsService;
use Illuminate\Foundation\Application;

class InspireMeProviderTest extends TestCase
{
    public function testQuotesServiceIsRegistered()
    {
        $provider = new InspireMeProvider($this->app);
        $quotesService = $this->app->make(QuotesService::class);

        $this->assertInstanceOf(QuotesService::class, $quotesService);
    }

    public function testQuoteesServiceIsRegistered()
    {
        $provider = new InspireMeProvider($this->app);
        $quoteesService = $this->app->make(QuoteesService::class);

        $this->assertInstanceOf(QuoteesService::class, $quoteesService);
    }

    public function testNationalitiesServiceIsRegistered()
    {
        $provider = new InspireMeProvider($this->app);
        $nationalitiesService = $this->app->make(NationalitiesService::class);

        $this->assertInstanceOf(NationalitiesService::class, $nationalitiesService);
    }

    public function testProfessionsServiceIsRegistered()
    {
        $provider = new InspireMeProvider($this->app);
        $professionsService = $this->app->make(ProfessionsService::class);

        $this->assertInstanceOf(ProfessionsService::class, $professionsService);
    }
}
