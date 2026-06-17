<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class IndexNowService
{
    /**
     * Submit URLs to IndexNow API
     */
    public static function submit(array $urls)
    {
        // Jangan jalankan di local environment
        if (app()->isLocal()) {
            Log::info('[IndexNow] Skipped on local environment', ['urls' => $urls]);
            return;
        }

        // Validasi: pastikan API key ada
        $key = config('services.indexnow.key');
        if (empty($key)) {
            Log::warning('[IndexNow] API key is not configured');
            return;
        }

        // Validasi: pastikan ada URL
        if (empty($urls)) {
            Log::warning('[IndexNow] No URLs provided');
            return;
        }

        // Ambil base URL dari config
        $baseUrl = rtrim(config('app.url'), '/');
        if (empty($baseUrl)) {
            Log::warning('[IndexNow] APP_URL is not configured');
            return;
        }

        // Konversi relative URLs ke absolute URLs
        $fullUrls = [];
        foreach ($urls as $url) {
            // Jika URL sudah absolute, biarkan
            if (strpos($url, 'http') === 0) {
                $fullUrls[] = $url;
            }
            // Jika relative, tambahkan base URL
            else {
                $fullUrls[] = $baseUrl . '/' . ltrim($url, '/');
            }
        }

        // Ambil host dari URL (tanpa http/https)
        $host = parse_url($baseUrl, PHP_URL_HOST);

        // Key location URL
        $keyLocation = $baseUrl . '/indexnow.txt';

        try {
            Log::info('[IndexNow] Submitting URLs', [
                'host' => $host,
                'url_count' => count($fullUrls),
                'urls' => $fullUrls
            ]);

            // Kirim request ke IndexNow API
            $response = Http::timeout(15)
                ->retry(2, 100) // Retry 2x dengan delay 100ms
                ->post('https://api.indexnow.org/indexnow', [
                    'host' => $host,
                    'key' => $key,
                    'keyLocation' => $keyLocation,
                    'urlList' => $fullUrls
                ]);

            // Cek response
            if ($response->successful()) {
                Log::info('[IndexNow] Submission successful', [
                    'status' => $response->status(),
                    'response' => $response->json() ?? $response->body(),
                    'urls_submitted' => count($fullUrls)
                ]);
            } else {
                Log::warning('[IndexNow] Submission failed', [
                    'status' => $response->status(),
                    'response' => $response->body(),
                    'urls' => $fullUrls
                ]);
            }

        } catch (\Exception $e) {
            Log::error('[IndexNow] Exception: ' . $e->getMessage(), [
                'urls' => $fullUrls,
                'host' => $host
            ]);
        }
    }
}
