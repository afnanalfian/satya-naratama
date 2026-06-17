<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('meeting_videos', function (Blueprint $table) {
            $table->string('cdn_library')->nullable()->after('youtube_thumbnail_url');
            $table->string('cdn_video_id')->nullable()->after('cdn_library');
            $table->enum('source', ['youtube', 'cdn'])->default('youtube')->after('cdn_video_id')->index();
        });
    }

    public function down(): void
    {
        Schema::table('meeting_videos', function (Blueprint $table) {
            $table->dropColumn([
                'cdn_library',
                'cdn_video_id',
                'source',
            ]);
        });
    }
};
