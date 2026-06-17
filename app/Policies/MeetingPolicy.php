<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Meeting;

class MeetingPolicy
{
    public function view(User $user, Meeting $meeting): bool
    {
        if (! $user->hasRole('siswa')) {
            return true;
        }
        //COURSE GRATIS → SEMUA MEETING GRATIS
        if ($meeting->course && $meeting->course->is_free) {
            return true;
        }

        //MEETING GRATIS (SATUAN)
        if ($meeting->is_free) {
            return true;
        }
        // Beli course → semua meeting terbuka
        if ($meeting->course_id && $user->hasCourse($meeting->course_id)) {
            return true;
        }

        // Beli meeting satuan
        return $user->hasEntitlement('meeting', $meeting->id);
    }
}
