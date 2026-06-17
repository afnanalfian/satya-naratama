<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;

class AssignSiswaRoleAzwara2026Seeder extends Seeder
{
    /**
     * Daftar email yang [NEW] dari TryoutAzwara2026Seeder.
     * Yang [EXISTING] tidak disentuh karena mungkin sudah punya role lain.
     */
    private array $newEmails = [
        'jenifer060408@gmail.com',
        'anindaajengagustinn@gmail.com',
        'chandrahw05@gmail.com',
        'andhikatulusp@gmail.com',
        'sarialika46@gmail.com',
        'putrimelany180406@gmail.com',
        'sarkw.nataifah28@gmail.com',
        'indocraft46@gmail.com',
        'ibnu40092@gmail.com',
        'rzzky44@gmail.com',
        'ahmadafif0824@gmail.com',
        'nuraminahfatma743@gmail.com',
        'aanandreafriza171097@gmail.com',
        'olilhalil5@gmail.com',
        'elsakusuma2023@gmail.com',
        'rifatorkay@gmail.com',
        'khadafimuammar08@gmail.com',
        'umarkayla50@gmail.com',
        'raihananlaksono@gmail.com',
        'indryrahmadany73@gmail.com',
        'gracesianturi83@gmail.com',
        'nadzwaalilatulmukhbitah@gmail.com',
        'simbolonangel78@gmail.com',
        'nurfiahchaeranizahwa@gmail.com',
        'naofalfitrahsertifikat@gmail.com',
        'nadiameila2728@gmail.com',
        'bevantab01@gmail.com',
        'firadhatulnafiah@gmail.com',
        'sherenpongkapadang@gmail.com',
        'genturtopoaji123@gmail.com',
        'shafelianifeli@gmail.com',
        'aufazaskia04@gmail.com',
        'if5040444@gmail.com',
        'ummulkhairunnisa123@gmail.com',
        'azzahraputriyoza07@gmail.com',
        'disimayshaluna@gmail.com',
        'amarafitranyy@gmail.com',
        'auliahawin5@gmail.com',
        'rholasmanam5474@gmail.com',
        'adnanlubisaaa@gmail.com',
        'marsyamarsha27@gmail.com',
        'salsabilaalifiani512@gmail.com',
        'tasyrifimam217@gmail.com',
        'budakalam26@gmail.com',
        'rimbawanrizi@gmail.com',
        'galangrizqulahrahendra@gmail.com',
        'aliongtarimus404@gmail.com',
        'joychristiansembiring@gmail.com',
        'wulandariikarestu@gmail.com',
        'iqbalhafizh28@gmail.com',
        'owynputri@gmail.com',
        'syalwariaharmonis13@gmail.com',
        'divaoktavia9amusago@gmail.com',
    ];

    public function run(): void
    {
        // Pastikan role siswa ada
        $role = Role::findByName('siswa', 'web');

        $assigned = 0;
        $skipped  = 0;
        $notFound = 0;

        foreach ($this->newEmails as $email) {
            $user = DB::table('users')->where('email', $email)->first();

            if (! $user) {
                $this->command->error("  [NOT FOUND] {$email}");
                $notFound++;
                continue;
            }

            // Pakai Eloquent model supaya Spatie bisa handle cache & pivot
            $userModel = \App\Models\User::find($user->id);

            if ($userModel->hasRole('siswa')) {
                $this->command->line("  [SKIP]     {$email} — sudah punya role siswa");
                $skipped++;
                continue;
            }

            $userModel->assignRole($role);
            $this->command->info("  [ASSIGNED] {$email}");
            $assigned++;
        }

        $this->command->newLine();
        $this->command->info("━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━");
        $this->command->info("  Role siswa di-assign : {$assigned}");
        $this->command->line("  Sudah punya role     : {$skipped}");
        if ($notFound > 0) {
            $this->command->error("  User tidak ditemukan : {$notFound}");
        }
        $this->command->info("━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━");
    }
}
