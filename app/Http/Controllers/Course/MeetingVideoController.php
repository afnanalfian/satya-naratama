<?php

namespace App\Http\Controllers\Course;

use App\Models\Meeting;
use App\Models\MeetingVideo;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Services\VideoSourceResolver;

class MeetingVideoController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | CREATE (form tambah video)
    |--------------------------------------------------------------------------
    */
    public function create(Meeting $meeting)
    {
        abort_if($meeting->video !== null, 409);

        return view('meetings.videos.create', compact('meeting'));
    }

    /*
    |--------------------------------------------------------------------------
    | STORE (simpan youtube video id)
    |--------------------------------------------------------------------------
    */
    public function store(
        Request $request,
        Meeting $meeting,
        VideoSourceResolver $resolver
    ) {
        abort_if($meeting->video()->exists(), 409);

        $request->validate([
            'source' => 'required|in:youtube,cdn',
            'title'  => 'required|string|max:255',
        ]);

        if ($request->source === 'youtube') {
            $request->validate([
                'youtube_video_id' => 'required|string',
            ]);
        }

        if ($request->source === 'cdn') {
            $request->validate([
                'cdn_video_id' => 'required|string',
            ]);
        }

        $resolver->store($meeting, $request->all());

        toast('success', 'Video berhasil ditambahkan');
        return redirect()->route('meeting.show', $meeting);
    }

    /*
    |--------------------------------------------------------------------------
    | EDIT (form edit video title + id)
    |--------------------------------------------------------------------------
    */
    public function edit(Meeting $meeting)
    {
        abort_if($meeting->video === null, 404);

        return view('meetings.videos.edit', [
            'meeting' => $meeting,
            'video'   => $meeting->video,
        ]);
    }

    /*
    |--------------------------------------------------------------------------
    | UPDATE (update metadata)
    |--------------------------------------------------------------------------
    */
    public function update(
        Request $request,
        Meeting $meeting,
        VideoSourceResolver $resolver
    ) {
        $video = $meeting->video;
        abort_if(! $video, 404);

        $request->validate([
            'source' => 'required|in:youtube,cdn',
            'title'  => 'required|string|max:255',
        ]);

        if ($request->source === 'youtube') {
            $request->validate([
                'youtube_video_id' => 'required|string',
            ]);
        }

        if ($request->source === 'cdn') {
            $request->validate([
                'cdn_video_id' => 'required|string',
            ]);
        }

        $resolver->update($video, $request->all());

        toast('success', 'Video berhasil diperbarui');
        return redirect()->route('meeting.show', $meeting);
    }
    /*
    |--------------------------------------------------------------------------
    | DESTROY (hapus video dari database)
    |--------------------------------------------------------------------------
    */
    public function destroy(Meeting $meeting)
    {
        $video = $meeting->video;
        abort_if(! $video, 404);

        // NOTE: Tidak hapus file CDN / YouTube
        $video->delete();

        toast('info', 'Video berhasil dihapus');
        return redirect()->route('meeting.show', $meeting);
    }

    /*
    |--------------------------------------------------------------------------
    | PLAYBACK (tampilkan youtube player)
    |--------------------------------------------------------------------------
    */
    public function playback(Meeting $meeting)
    {
        $video = $meeting->video;
        abort_if(! $video || ! $video->is_ready, 404);

        return view('meetings.videos.playback', [
            'meeting' => $meeting,
            'video'   => $video,
        ]);
    }
}
