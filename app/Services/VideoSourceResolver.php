<?php

namespace App\Services;

use App\Models\Meeting;
use App\Models\MeetingVideo;

class VideoSourceResolver
{
    /**
     * Simpan video sesuai config
     */
    public function store(Meeting $meeting, array $data): MeetingVideo
    {
        if ($data['source'] === 'cdn') {
            return $this->storeCdn($meeting, $data);
        }

        return $this->storeYoutube($meeting, $data);
    }

    protected function storeYoutube(Meeting $meeting, array $data): MeetingVideo
    {
        return MeetingVideo::create([
            'meeting_id'       => $meeting->id,
            'title'            => $data['title'],
            'youtube_video_id' => $data['youtube_video_id'],
            'source'           => 'youtube',
        ]);
    }

    protected function storeCdn(Meeting $meeting, array $data): MeetingVideo
    {
        return MeetingVideo::create([
            'meeting_id'  => $meeting->id,
            'title'       => $data['title'],
            'cdn_library' => config('services.bunny.library_id'),
            'cdn_video_id'=> $data['cdn_video_id'],
            'source'      => 'cdn',
        ]);
    }

    /**
     * Update metadata
     */
    public function update(MeetingVideo $video, array $data): MeetingVideo
    {
        if ($data['source'] === 'cdn') {
            $video->update([
                'source'           => 'cdn',
                'title'            => $data['title'],
                'cdn_library'      => config('services.bunny.library_id'),
                'cdn_video_id'     => $data['cdn_video_id'],
                'youtube_video_id' => null,
            ]);
        } else {
            $video->update([
                'source'           => 'youtube',
                'title'            => $data['title'],
                'youtube_video_id' => $data['youtube_video_id'],
                'cdn_video_id'     => null,
                'cdn_library'      => null,
            ]);
        }

        return $video;
    }

}
