<?php

namespace App\Services;

use Illuminate\Support\Carbon;

class BunnySignedUrl
{
    public function generate(string $libraryId, string $videoId): string
    {
        $expires = Carbon::now()
            ->addSeconds(config('services.bunny.signed_expiry'))
            ->timestamp;

        $securityKey = config('services.bunny.stream_key');

        // PENTING: ini BUKAN HMAC
        $token = hash(
            'sha256',
            $securityKey . $videoId . $expires
        );

        return "https://iframe.mediadelivery.net/embed/{$libraryId}/{$videoId}"
             . "?token={$token}&expires={$expires}";
    }
}
