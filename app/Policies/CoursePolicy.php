<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Course;

class CoursePolicy
{
    public function view(User $user, Course $course): bool
    {
        return true;
        // if (! $user->hasRole('siswa')) {
        //     return true;
        // }
        // // COURSE GRATIS → SEMUA BOLEH AKSES
        // if ($course->is_free) {
        //     return true;
        // }
        // return $user->hasCourse($course->id);
    }
}
