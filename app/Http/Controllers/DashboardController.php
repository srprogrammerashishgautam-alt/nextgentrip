<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;
use App\Models\Hotel;
use Inertia\Inertia;
use Inertia\Response;

class DashboardController extends Controller
{
    public function index(Request $request): Response
    {
        return Inertia::render('Dashboard', [
            'user' => $request->user()?->only(['id', 'name', 'email', 'mobile']),
            'metrics' => [
                'hotels' => Hotel::count(),
                'onboarding' => 0,
                'bookings' => Booking::count(),
                'revenue' => (float) Booking::sum('total_amount'),
            ],
            'tasks' => [
                ['label' => 'Complete property profile', 'status' => 'Pending'],
                ['label' => 'Upload KYC documents', 'status' => 'Pending'],
                ['label' => 'Configure room types and inventory', 'status' => 'Pending'],
                ['label' => 'Connect first OTA channel', 'status' => 'Pending'],
            ],
        ]);
    }
}
