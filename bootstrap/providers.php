<?php

return [
    App\Providers\AppServiceProvider::class,
    App\Providers\Filament\AdminPanelProvider::class,
    Modules\Analytics\Providers\AnalyticsServiceProvider::class,
    Modules\Audit\Providers\AuditServiceProvider::class,
    Modules\Bookings\Providers\BookingsServiceProvider::class,
    Modules\Channels\Providers\ChannelsServiceProvider::class,
    Modules\Content\Providers\ContentServiceProvider::class,
    Modules\Contracts\Providers\ContractsServiceProvider::class,
    Modules\Hotels\Providers\HotelsServiceProvider::class,
    Modules\Inventory\Providers\InventoryServiceProvider::class,
    Modules\Kyc\Providers\KycServiceProvider::class,
    Modules\Notifications\Providers\NotificationsServiceProvider::class,
    Modules\Onboarding\Providers\OnboardingServiceProvider::class,
    Modules\Pms\Providers\PmsServiceProvider::class,
    Modules\Rates\Providers\RatesServiceProvider::class,
    Modules\Revenue\Providers\RevenueServiceProvider::class,
    Modules\Rooms\Providers\RoomsServiceProvider::class,
    Modules\Support\Providers\SupportServiceProvider::class,
];
