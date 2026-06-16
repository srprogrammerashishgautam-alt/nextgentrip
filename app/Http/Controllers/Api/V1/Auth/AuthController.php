<?php

namespace App\Http\Controllers\Api\V1\Auth;

use App\Contracts\Auth\MagicLinkServiceInterface;
use App\Contracts\Auth\OtpServiceInterface;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Support\ApiResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(Request $request): JsonResponse
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:120'],
            'email' => ['required', 'email', 'unique:users,email'],
            'mobile' => ['nullable', 'string', 'max:25'],
            'password' => ['required', 'string', 'min:8'],
            'property_type' => ['nullable', 'string', 'max:80'],
        ]);

        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'mobile' => $data['mobile'] ?? null,
            'password' => Hash::make($data['password']),
        ]);

        $user->assignRole('hotel_owner');

        return ApiResponse::success([
            'user' => $user,
            'token' => $user->createToken('api')->plainTextToken,
            'refresh_token' => null,
        ], 'Registered', status: 201);
    }

    public function login(Request $request, MagicLinkServiceInterface $magicLinks): JsonResponse
    {
        if ($request->filled('magic_token')) {
            $user = $magicLinks->validate((string) $request->input('magic_token'));

            return $user
                ? $this->authenticated($user)
                : ApiResponse::error('Invalid magic link token', status: 422);
        }

        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required', 'string'],
        ]);

        if (! Auth::attempt($credentials)) {
            return ApiResponse::error('Invalid credentials', status: 401);
        }

        return $this->authenticated($request->user());
    }

    public function sendOtp(Request $request, OtpServiceInterface $otp): JsonResponse
    {
        $data = $request->validate([
            'mobile' => ['nullable', 'string', 'required_without:email'],
            'email' => ['nullable', 'email', 'required_without:mobile'],
        ]);

        $reference = $otp->send($data['mobile'] ?? $data['email']);

        return ApiResponse::success([
            'otp_ref' => $reference,
            'expires_in' => 600,
        ], 'OTP sent');
    }

    public function verifyOtp(Request $request, OtpServiceInterface $otp): JsonResponse
    {
        $data = $request->validate([
            'otp_ref' => ['required', 'string'],
            'otp_code' => ['required', 'string'],
        ]);

        if (! $otp->verify($data['otp_ref'], $data['otp_code'])) {
            return ApiResponse::error('Invalid OTP', status: 422);
        }

        return ApiResponse::success(['verified' => true], 'OTP verified');
    }

    public function sendMagicLink(Request $request, MagicLinkServiceInterface $magicLinks): JsonResponse
    {
        $data = $request->validate(['email' => ['required', 'email']]);
        $user = User::where('email', $data['email'])->firstOrFail();

        return ApiResponse::success([
            'magic_token' => $magicLinks->issue($user),
            'expires_in' => 900,
        ], 'Magic link issued');
    }

    public function refresh(Request $request): JsonResponse
    {
        return ApiResponse::success([
            'token' => $request->user()?->createToken('api')->plainTextToken,
            'refresh_token' => null,
        ], 'Token refreshed');
    }

    public function me(Request $request): JsonResponse
    {
        $user = $request->user();

        return ApiResponse::success([
            'user' => $user,
            'roles' => method_exists($user, 'getRoleNames') ? $user->getRoleNames() : [],
            'permissions' => method_exists($user, 'getAllPermissions') ? $user->getAllPermissions()->pluck('name') : [],
            'hotels' => [],
        ]);
    }

    private function authenticated(User $user): JsonResponse
    {
        return ApiResponse::success([
            'user' => $user,
            'token' => $user->createToken('api')->plainTextToken,
            'refresh_token' => null,
            'permissions' => method_exists($user, 'getAllPermissions') ? $user->getAllPermissions()->pluck('name') : [],
        ], 'Authenticated');
    }
}
