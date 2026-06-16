<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class SetTenantContext
{
    public function handle(Request $request, Closure $next): mixed
    {
        $hotelId = $request->header('X-Hotel-Id') ?: $request->route('hotel');

        if ($hotelId) {
            App::instance('tenant.hotel_id', (string) $hotelId);
        }

        return $next($request);
    }
}
