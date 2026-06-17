<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Services\BunnySignedUrl;

class MeetingVideo extends Model
{
    use HasFactory;

    protected $fillable = [
        'meeting_id',
        'title',

        // YouTube
        'youtube_video_id',
        'youtube_thumbnail_url',

        // Bunny
        'cdn_library',
        'cdn_video_id',

        // Source
        'source',
    ];

    /*
    |--------------------------------------------------------------------------
    | Relationships
    |--------------------------------------------------------------------------
    */
    public function meeting()
    {
        return $this->belongsTo(Meeting::class);
    }

    /*
    |--------------------------------------------------------------------------
    | Platform Resolver
    |--------------------------------------------------------------------------
    */

    public function isCdn(): bool
    {
        return $this->source === 'cdn';
    }

    public function isYoutube(): bool
    {
        return $this->source === 'youtube';
    }

    /*
    |--------------------------------------------------------------------------
    | Accessors
    |--------------------------------------------------------------------------
    */

    /**
     * Embed URL (digunakan di playback.blade.php)
     */
    public function getEmbedUrlAttribute(): ?string
    {
        if ($this->source === 'cdn') {
            if (! $this->cdn_library || ! $this->cdn_video_id) {
                return null;
            }

            return app(BunnySignedUrl::class)
                ->generate($this->cdn_library, $this->cdn_video_id);
        }

        if (! $this->youtube_video_id) {
            return null;
        }

        return "https://www.youtube.com/embed/{$this->youtube_video_id}?modestbranding=1&rel=0";
    }

    /**
     * Thumbnail URL (digunakan di listing)
     */
    public function getThumbnailAttribute(): ?string
    {
        if ($this->isCdn()) {
            $host = config('services.bunny.cdn_hostname');

            return filled($host) && filled($this->cdn_video_id)
                ? "https://{$host}/{$this->cdn_video_id}/thumbnail.jpg"
                : null;
        }

        return filled($this->youtube_video_id)
            ? "https://img.youtube.com/vi/{$this->youtube_video_id}/hqdefault.jpg"
            : null;
    }

    /**
     * Nama platform (UI)
     */
    public function getPlatformAttribute(): string
    {
        return $this->isCdn()
            ? 'Bunny.net'
            : 'YouTube';
    }

    /**
     * Apakah video siap diputar
     */
    public function getIsReadyAttribute(): bool
    {
        if ($this->isCdn()) {
            return filled($this->cdn_video_id);
        }

        return filled($this->youtube_video_id);
    }
}
