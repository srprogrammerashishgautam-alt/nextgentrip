<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class EnsureApiResponseEnvelope
{
    public function handle(Request $request, Closure $next): mixed
    {
        $response = $next($request);

        if (! $request->is('api/*') || ! $response instanceof JsonResponse) {
            return $response;
        }

        $payload = $response->getData(true);

        if (array_key_exists('success', $payload)
            && array_key_exists('data', $payload)
            && array_key_exists('message', $payload)
            && array_key_exists('meta', $payload)) {
            return $response;
        }

        return response()->json([
            'success' => $response->isSuccessful(),
            'data' => $payload,
            'message' => $response->isSuccessful() ? 'OK' : 'Request failed',
            'meta' => (object) [],
        ], $response->getStatusCode(), $response->headers->all());
    }
}
