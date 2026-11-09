<?php

namespace Database\Seeders;

use App\Models\Course;
use App\Models\Kecamatan;
use App\Models\Meeting;
use App\Models\MeetingAttendance;
use App\Models\PhysicalEvaluation;
use App\Models\PhysicalEvaluationResult;
use App\Models\StudentPhysicalRecord;
use App\Models\StudentRegistration;
use App\Models\Teacher;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

/**
 * Data contoh untuk pengembangan lokal / pengujian.
 * JANGAN dijalankan di server produksi yang sudah berisi data asli.
 *   php artisan db:seed --class=DemoDataSeeder
 */
class DemoDataSeeder extends Seeder
{
    public function run(): void
    {
        $pw = Hash::make('password');
        $admin = User::firstOrCreate(['email' => 'admin@demo.test'], ['name' => 'Admin Demo', 'password' => $pw, 'is_active' => true, 'email_verified_at' => now()]);
        $admin->syncRoles('admin');

        $tentorUser = User::firstOrCreate(['email' => 'tentor@demo.test'], ['name' => 'Kak Rina', 'password' => $pw, 'is_active' => true, 'email_verified_at' => now()]);
        $tentorUser->syncRoles('tentor');
        $teacher = Teacher::firstOrCreate(['user_id' => $tentorUser->id], ['bio' => 'Alumni STIS, tentor matematika & TIU.']);

        $kec = Kecamatan::where('regency_id', 7309)->first();
        $kel = $kec?->kelurahans()->first() ?? \App\Models\Kelurahan::where('kecamatan_id', $kec?->id)->first();

        $students = collect();
        foreach ([['Andi Pratama', 'L'], ['Siti Rahma', 'P'], ['Budi Santoso', 'L'], ['Nur Aisyah', 'P'], ['Rizky Maulana', 'L'], ['Dewi Lestari', 'P']] as $i => [$name, $g]) {
            $email = $i === 0 ? 'siswa@demo.test' : 'siswa'.($i + 1).'@demo.test';
            $u = User::firstOrCreate(['email' => $email], ['name' => $name, 'password' => $pw, 'is_active' => true, 'email_verified_at' => now(), 'phone' => '0812345678'.$i]);
            $u->syncRoles('siswa');
            if ($kec && $kel && ! $u->studentRegistration) {
                StudentRegistration::create([
                    'full_name' => $name, 'birth_date' => now()->subYears(17)->subDays($i * 40), 'gender' => $g, 'school_origin' => 'SMAN '.($i + 1).' Pangkep',
                    'class' => ['X', 'XI', 'XII', 'Alumni'][$i % 4], 'phone' => '0812345678'.$i, 'kecamatan_id' => $kec->id, 'kelurahan_id' => $kel->id,
                    'height_cm' => 165 + $i, 'weight_kg' => 55 + $i, 'priority_university_1' => ['AKPOL', 'STIS', 'IPDN', 'AKMIL', 'STAN', 'STMKG'][$i],
                    'parent_name' => 'Orang Tua '.$name, 'parent_phone' => '0813000000'.$i, 'email' => $email, 'password' => $pw, 'registration_fee' => 6000000,
                    'payment_status' => 'verified', 'registration_status' => 'verified', 'user_id' => $u->id, 'shirt_size' => 'L',
                ]);
            }
            $students->push($u);
        }

        $akademik = Course::firstOrCreate(['slug' => 'kelas-akademik-kedinasan'], ['name' => 'Kelas Akademik Kedinasan', 'type' => 'akademik', 'description' => 'TIU, TWK, TKP dan Matematika untuk seleksi sekolah kedinasan.', 'is_free' => false]);
        $jasmani = Course::firstOrCreate(['slug' => 'latihan-jasmani'], ['name' => 'Latihan Jasmani TNI–POLRI', 'type' => 'jasmani', 'description' => 'Lari 12 menit, pull up, push up, sit up, shuttle run.', 'is_free' => false]);
        $teacher->courses()->syncWithoutDetaching([$akademik->id, $jasmani->id]);

        if ($akademik->meetings()->count() === 0) {
            foreach (range(1, 6) as $n) {
                foreach ([[$akademik, 'Pertemuan '.$n.' – TIU'], [$jasmani, 'Latihan Jasmani '.$n]] as [$c, $title]) {
                    $m = Meeting::create(['course_id' => $c->id, 'title' => $title, 'scheduled_at' => now()->subWeeks(6 - $n)->setTime(16, 0), 'status' => $n < 6 ? 'done' : 'upcoming', 'created_by' => $tentorUser->id]);
                    if ($n < 6) {
                        foreach ($students as $k => $s) {
                            if (($k + $n) % 4 === 0) continue;
                            MeetingAttendance::create(['meeting_id' => $m->id, 'user_id' => $s->id, 'status' => ($k + $n) % 5 === 0 ? 'izin' : 'hadir', 'method' => 'scan', 'marked_by' => $tentorUser->id, 'marked_at' => $m->scheduled_at->copy()->addMinutes($k * 3)]);
                        }
                    }
                }
            }
            Meeting::create(['course_id' => $akademik->id, 'title' => 'Live Class – Deret Angka', 'scheduled_at' => now()->setTime(19, 0), 'status' => 'live', 'created_by' => $tentorUser->id, 'zoom_link' => 'https://zoom.us/j/123456789']);
        }

        if (PhysicalEvaluation::count() === 0) {
            foreach ([2, 1, 0] as $ago) {
                $ev = PhysicalEvaluation::create(['title' => 'Evaluasi Jasmani '.now()->subMonths($ago)->translatedFormat('F Y'), 'period' => now()->subMonths($ago)->startOfMonth(), 'held_on' => now()->subMonths($ago)->startOfMonth()->addDays(5), 'location' => 'Lapangan Pangkep', 'created_by' => $admin->id]);
                foreach ($students as $k => $s) {
                    PhysicalEvaluationResult::create(['physical_evaluation_id' => $ev->id, 'user_id' => $s->id, 'gender' => $s->studentRegistration?->gender,
                        'run_12min_m' => 2200 + $k * 60 + (2 - $ago) * 80, 'pull_up_chinning' => 5 + $k + (2 - $ago), 'push_up' => 25 + $k * 2 + (2 - $ago) * 3, 'sit_up' => 30 + $k + (2 - $ago) * 2,
                        'shuttle_run_sec' => 19.5 - $k * 0.2 - (2 - $ago) * 0.3, 'recorded_by' => $admin->id]);
                    StudentPhysicalRecord::firstOrCreate(['user_id' => $s->id, 'period' => now()->subMonths($ago)->startOfMonth()->toDateString()], ['height_cm' => 165 + $k, 'weight_kg' => 55 + $k + (2 - $ago) * 0.5, 'has_illness' => $k === 2 && $ago === 0, 'illness_notes' => $k === 2 && $ago === 0 ? 'Flu ringan' : null, 'has_injury' => false, 'updated_by' => $admin->id]);
                }
            }
        }



        // ===== Toko =====
        if (\App\Models\PricingRule::count() === 0) {
            foreach ([['meeting', 1, 3, 75000, null], ['meeting', 4, null, 60000, null], ['course_package', 1, null, null, 1500000], ['tryout', 1, null, null, 35000], ['addon', 1, null, null, 50000]] as [$t, $min, $max, $pu, $fx]) {
                \App\Models\PricingRule::create(['product_type' => $t, 'min_qty' => $min, 'max_qty' => $max, 'price_per_unit' => $pu, 'fixed_price' => $fx, 'is_active' => true]);
            }
            \App\Models\Product::firstOrCreate(['type' => 'addon'], ['name' => 'Akses Kuis Harian', 'is_active' => true]);
            \App\Models\Discount::create(['name' => 'Promo Akhir Tahun', 'type' => 'percentage', 'value' => 10, 'max_discount' => 200000, 'is_active' => true]);
            \App\Models\Discount::create(['name' => 'Voucher Alumni', 'code' => 'ALUMNI50', 'type' => 'fixed', 'value' => 50000, 'is_active' => true]);
        }

        // ===== Bank soal & ujian =====
        if (\App\Models\QuestionCategory::count() === 0) {
            $cat = \App\Models\QuestionCategory::create(['name' => 'SKD', 'slug' => 'skd', 'description' => 'Seleksi Kompetensi Dasar']);
            $mats = [];
            foreach (['twk' => 'Wawasan Kebangsaan', 'tiu' => 'Deret & Hitungan', 'tkp' => 'Pelayanan Publik'] as $tt => $name) {
                $mats[$tt] = \App\Models\QuestionMaterial::create(['category_id' => $cat->id, 'name' => $name, 'slug' => strtolower(preg_replace('/[^a-zA-Z0-9]/', '', $name))]);
            }
            $tryout = \App\Models\Exam::create(['type' => 'tryout', 'test_type' => 'skd', 'title' => 'Tryout SKD Akbar #1', 'exam_date' => now()->subDay(), 'duration_minutes' => 100, 'status' => 'inactive', 'created_by' => $admin->id]);
            $order = 0;
            foreach (['twk', 'tiu', 'tkp'] as $tt) {
                foreach (range(1, 4) as $n) {
                    $text = $tt === 'tiu' ? "Berapakah hasil dari \\( {$n} \\times 12 + \\frac{1}{2} \\)?" : ($tt === 'twk' ? "Pancasila sebagai dasar negara tercantum dalam … (soal {$n})" : "Rekan kerja Anda meminta bantuan saat Anda sibuk. Sikap Anda? (soal {$n})");
                    $q = \App\Models\Question::create(['material_id' => $mats[$tt]->id, 'type' => 'mcq', 'test_type' => $tt, 'question_text' => $text, 'explanation' => 'Pembahasan contoh untuk soal ini.']);
                    foreach (['A', 'B', 'C', 'D', 'E'] as $k => $l) {
                        \App\Models\QuestionOption::create(['question_id' => $q->id, 'option_text' => $tt === 'tiu' ? (string) ($n * 12 + $k) . ',5' : "Pilihan {$l}", 'is_correct' => $tt !== 'tkp' && $k === 0, 'order' => $k + 1, 'weight' => $tt === 'tkp' ? 5 - $k : 0]);
                    }
                    \App\Models\ExamQuestion::create(['exam_id' => $tryout->id, 'question_id' => $q->id, 'order' => ++$order]);
                }
            }
            $tryout->update(['status' => 'active']);
            \App\Models\Exam::create(['type' => 'quiz', 'test_type' => 'general', 'title' => 'Kuis Harian TIU', 'exam_date' => now(), 'duration_minutes' => 15, 'status' => 'inactive', 'created_by' => $admin->id]);

            // dua siswa sudah mengerjakan
            foreach ($students->take(2) as $k => $s) {
                $at = \App\Models\ExamAttempt::create(['exam_id' => $tryout->id, 'user_id' => $s->id, 'started_at' => now()->subHours(3)]);
                foreach ($tryout->questions()->with('question.options')->get() as $eq) {
                    $opt = $eq->question->options->sortBy('order')->values()[($eq->order + $k) % 3];
                    \App\Models\ExamAnswer::create(['attempt_id' => $at->id, 'question_id' => $eq->question_id, 'selected_options' => ['type' => 'mcq', 'mcq_answers' => [$opt->id]], 'is_correct' => (bool) $opt->is_correct]);
                }
                $r = app(\App\Services\ExamScoringService::class)->scoreAttempt($at->fresh());
                $at->update(['is_submitted' => true, 'submitted_at' => now()->subHours(2), 'score' => $r['score'], 'correct_count' => $r['correct'], 'wrong_count' => $r['wrong']]);
            }
        }

        $this->command?->info('Demo: admin@demo.test / tentor@demo.test / siswa@demo.test (password: password)');
    }
}
