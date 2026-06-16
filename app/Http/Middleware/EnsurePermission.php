<?php

namespace App\Http\Middleware;

use App\Support\ApiResponse;
use Closure;
use Illuminate\Http\Request;

class EnsurePermission
{
    public function handle(Request $request, Closure $next, string $permission): mixed
    {
        $user = $request->user();

        if (! $user || ! method_exists($user, 'can') || ! $user->can($permission)) {
            return ApiResponse::error('Forbidden', status: 403);
        }

        return $next($request);
    }
}
