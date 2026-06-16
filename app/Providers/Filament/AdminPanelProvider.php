<?php

namespace App\Providers\Filament;

use Filament\Http\Middleware\Authenticate;
use Filament\Panel;
use Filament\PanelProvider;

class AdminPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->default()
            ->id('admin')
            ->path(config('filament.admin_panel_path', 'admin'))
            ->brandName(config('filament.brand_name', 'NextGenTrip Admin'))
            ->login()
            ->authMiddleware([
                Authenticate::class,
            ]);
    }
}
