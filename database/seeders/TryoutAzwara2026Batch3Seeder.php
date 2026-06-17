<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use App\Models\User;
use Carbon\Carbon;

class TryoutAzwara2026Batch3Seeder extends Seeder
{
    private array $users = [
        ['name' => 'RIYANTO HERY FAUZI',           'email' => 'fauziriyanto8@gmail.com',              'password' => 'TO-AZWARA70'],
        ['name' => 'isan',                           'email' => 'isangans2005@gmail.com',               'password' => 'TO-AZWARA71'],
        ['name' => 'Mifta',                          'email' => 'miftamaisella@gmail.com',              'password' => 'TO-AZWARA72'],
        ['name' => 'CHATIB RADITIYA RAHMAWAN',       'email' => 'chatib.raditiya.rahmawan@gmail.com',  'password' => 'TO-AZWARA73'],
        ['name' => 'Barlian Saputra',                'email' => 'brianonaqjelsa@gmail.com',            'password' => 'TO-AZWARA74'],
        ['name' => 'MUHAMAD FARID AKBAR',            'email' => 'muhamadfaridakbar56@gmail.com',       'password' => 'TO-AZWARA75'],
        ['name' => 'Virmansyah Putra Abdullah',      'email' => 'yhjfghpooki@gmail.com',               'password' => 'TO-AZWARA76'],
        ['name' => 'Rahmatullah',                    'email' => 'yahyarahmatullah038@gmail.com',        'password' => 'TO-AZWARA77'],
        ['name' => 'Elvaretta Claudya Azzahra',      'email' => 'claudyaelvaretta7@gmail.com',         'password' => 'TO-AZWARA78'],
        ['name' => 'm-',                             'email' => 'foraiakun@gmail.com',                 'password' => 'TO-AZWARA79'],
    ];

    public function run(): void
    {
        $now  = Carbon::now();
        $role = Role::findByName('siswa', 'web');

        foreach ($this->users as $data) {
            $existing = DB::table('users')->where('email', $data['email'])->first();

            if ($existing) {
                $userId = $existing->id;
                $this->command->warn("  [EXISTING] {$data['email']}");
            } else {
                $userId = DB::table('users')->insertGetId([
                    'name'              => $data['name'],
                    'email'             => $data['email'],
                    'password'          => Hash::make($data['password']),
                    'is_active'         => 1,
                    'province_id'       => null,
                    'regency_id'        => null,
                    'phone'             => null,
                    'avatar'            => null,
                    'email_verified_at' => null,
                    'created_at'        => $now,
                    'updated_at'        => $now,
                ]);
                $this->command->info("  [NEW]      {$data['email']}");
            }

            // Entitlement tryout #19
            $hasEntitlement = DB::table('user_entitlements')
                ->where('user_id',          $userId)
                ->where('entitlement_type', 'tryout')
                ->where('entitlement_id',   19)
                ->exists();

            if (! $hasEntitlement) {
                DB::table('user_entitlements')->insert([
                    'user_id'          => $userId,
                    'entitlement_type' => 'tryout',
                    'entitlement_id'   => 19,
                    'source'           => 'purchase',
                    'expires_at'       => null,
                    'created_at'       => $now,
                    'updated_at'       => $now,
                ]);
                $this->command->line("  [ENTITLE]  tryout #19 ditambahkan");
            } else {
                $this->command->line("  [SKIP ENT] entitlement sudah ada");
            }

            // Assign role siswa
            $userModel = User::find($userId);
            if (! $userModel->hasRole('siswa')) {
                $userModel->assignRole($role);
                $this->command->info("  [ROLE]     siswa di-assign");
            } else {
                $this->command->line("  [SKIP ROLE] sudah punya role siswa");
            }

            $this->command->line('');
        }

        $this->command->info("━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━");
        $this->command->info("  Selesai! 10 user diproses.");
        $this->command->info("━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━");
    }
}
