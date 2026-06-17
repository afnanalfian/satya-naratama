<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Exam;
use App\Models\Meeting;

class ExamPolicy
{
    public function view(User $user, Exam $exam): bool
    {
        // Admin / tentor / dll → bebas
        if (! $user->hasRole('siswa')) {
            return true;
        }

        return match ($exam->type) {

            // ======================
            // TRYOUT → akses global / paket
            // ======================
            'tryout' => $user->hasTryoutAccess($exam->id),

            // ======================
            // QUIZ → akses global
            // ======================
            'quiz' => $user->hasQuizAccess(),

            // ======================
            // BLIND & POST TEST
            // ======================
            'blind_test',
            'post_test' => $this->canAccessMeetingExam($user, $exam),

            default => false,
        };
    }

    protected function canAccessMeetingExam(User $user, Exam $exam): bool
    {
        /**
         * ======================================
         * 1. Exam harus melekat ke Meeting
         * ======================================
         */
        $meeting = $exam->owner;

        if (! $meeting instanceof Meeting) {
            return false;
        }

        /**
         * ======================================
         * 2. MEETING GRATIS → SEMUA BOLEH
         * ======================================
         */
        if ($meeting->is_free) {
            return true;
        }

        /**
         * ======================================
         * 3. COURSE GRATIS → SEMUA BOLEH
         * ======================================
         */
        if ($meeting->course && $meeting->course->is_free) {
            return true;
        }

        /**
         * ======================================
         * 4. USER BELI COURSE
         * ======================================
         */
        if (
            $meeting->course_id &&
            $user->hasCourse($meeting->course_id)
        ) {
            return true;
        }

        /**
         * ======================================
         * 5. USER BELI MEETING SATUAN
         * ======================================
         */
        return $user->hasEntitlement('meeting', $meeting->id);
    }
}
