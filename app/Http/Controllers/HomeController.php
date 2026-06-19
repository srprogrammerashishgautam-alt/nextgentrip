<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use Inertia\Response;

class HomeController extends Controller
{
    public function index(): Response
    {
        return Inertia::render('Home', [
            'stats' => [
                ['label' => 'Auto onboarding target', 'value' => '95%'],
                ['label' => 'Go-live target', 'value' => '30 min'],
                ['label' => 'Scale target', 'value' => '100K+ hotels'],
            ],
        ]);
    }
}
