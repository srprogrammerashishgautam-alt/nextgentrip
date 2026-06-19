<?php

namespace App\Providers;

use App\Contracts\AI\AiGatewayInterface;
use App\Contracts\Acquisition\HotelDataProviderInterface;
use App\Contracts\Auth\MagicLinkServiceInterface;
use App\Contracts\Auth\OtpServiceInterface;
use App\Contracts\Events\EventBusInterface;
use App\Services\AI\MockAiGateway;
use App\Services\Acquisition\MockHotelDataProvider;
use App\Services\Auth\MockMagicLinkService;
use App\Services\Auth\MockOtpService;
use App\Services\Events\MockKafkaEventBus;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(MagicLinkServiceInterface::class, MockMagicLinkService::class);
        $this->app->bind(OtpServiceInterface::class, MockOtpService::class);
        $this->app->bind(AiGatewayInterface::class, MockAiGateway::class);
        $this->app->bind(EventBusInterface::class, MockKafkaEventBus::class);
        $this->app->bind(HotelDataProviderInterface::class, MockHotelDataProvider::class);
    }
}
