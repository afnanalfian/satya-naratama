<?php

namespace App\Http\Controllers\Teras;

use App\Http\Controllers\Controller;
use App\Services\LandingService;
use Illuminate\Support\Facades\Cache;

class LandingController extends Controller
{
    public function index(LandingService $landingService)
    {
        $data = Cache::remember(
            'landing_page_v1',
            300,
            fn () => $landingService->getLandingData()
        );

        return view('front.landing', $data);
    }
}
