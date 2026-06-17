<?php

use Illuminate\Support\Facades\Route;
use App\Models\Regency;
use Laravel\Sanctum\Http\Middleware\EnsureFrontendRequestsAreStateful;


Route::get('/regencies/{province_id}', function ($province_id) {
    return response()->json(
        Regency::where('province_id', $province_id)
            ->orderBy('name')
            ->get(['id', 'name'])
    );
})->withoutMiddleware([
    EnsureFrontendRequestsAreStateful::class,
]);

Route::get('/courses/{course}/all-meetings', function (App\Models\Course $course) {
    // Ambil SEMUA meetings tanpa filter tanggal
    $meetings = $course->meetings()
        ->orderBy('scheduled_at')
        ->get()
        ->map(function ($meeting) {
            return [
                'id' => $meeting->id,
                'title' => $meeting->title,
                'scheduled_at' => $meeting->scheduled_at,
                'scheduled_at_formatted' => $meeting->scheduled_at->translatedFormat('d F Y, H:i'),
                'status' => $meeting->status,
            ];
        });

    return response()->json([
        'success' => true,
        'meetings' => $meetings,
        'total' => $meetings->count(),
    ]);
});
