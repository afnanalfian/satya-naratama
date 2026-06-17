<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class TryoutAzwara2026Seeder extends Seeder
{
    /**
     * Daftar user yang akan di-seed.
     *
     * Kolom "existing_account": true  → email sudah terdaftar di sistem,
     *                                    hanya user_entitlements yang akan dibuat.
     *                           false → user baru, akan dibuat beserta entitlements-nya.
     *
     * Tandai kolom existing_account = true untuk email yang sudah punya akun.
     */
    private array $users = [
        // ── Tandai existing_account = true jika email sudah ada di DB ──
        ['name' => 'Azima',                          'email' => 'madebythesin@gmail.com',          'password' => 'TO-AZWARA01', 'existing_account' => false],
        ['name' => 'Jenifer Laura Efendi',            'email' => 'jenifer060408@gmail.com',          'password' => 'TO-AZWARA02', 'existing_account' => false],
        ['name' => 'Aninda Ajeng Agustin',            'email' => 'anindaajengagustinn@gmail.com',    'password' => 'TO-AZWARA03', 'existing_account' => false],
        ['name' => 'Muh. Farhan Nazwarul Fadil',      'email' => 'lekocaddicoto@gmail.com',          'password' => 'TO-AZWARA04', 'existing_account' => false],
        ['name' => 'CHANDRA HAFIDZ WICAKSONO',        'email' => 'chandrahw05@gmail.com',            'password' => 'TO-AZWARA05', 'existing_account' => false],
        ['name' => 'Andhika Tulus Pratama',           'email' => 'andhikatulusp@gmail.com',          'password' => 'TO-AZWARA06', 'existing_account' => false],
        ['name' => 'alika intan',                     'email' => 'sarialika46@gmail.com',            'password' => 'TO-AZWARA07', 'existing_account' => false],
        ['name' => 'Mellany',                         'email' => 'putrimelany180406@gmail.com',      'password' => 'TO-AZWARA08', 'existing_account' => false],
        ['name' => 'SARA NATA HUDAIFAH',              'email' => 'sarkw.nataifah28@gmail.com',       'password' => 'TO-AZWARA09', 'existing_account' => false],
        ['name' => 'Muh. Hafidzca Aulia Akbar',       'email' => 'indocraft46@gmail.com',            'password' => 'TO-AZWARA10', 'existing_account' => false],
        ['name' => 'Ibnu Khasan',                     'email' => 'ibnu40092@gmail.com',              'password' => 'TO-AZWARA11', 'existing_account' => false],
        ['name' => 'MUHAMMAD RIZKY RIYANTO',          'email' => 'rzzky44@gmail.com',                'password' => 'TO-AZWARA12', 'existing_account' => false],
        ['name' => 'Ahmad Afif Natsir',               'email' => 'ahmadafif0824@gmail.com',          'password' => 'TO-AZWARA13', 'existing_account' => false],
        ['name' => 'Ibarkah Ramdhan N',               'email' => 'ibarmdhan1@gmail.com',             'password' => 'TO-AZWARA14', 'existing_account' => false],
        ['name' => 'aku pasti lulus cpns 2026',       'email' => 'nuraminahfatma743@gmail.com',      'password' => 'TO-AZWARA15', 'existing_account' => false],
        ['name' => 'Andre Afrisa',                    'email' => 'aanandreafriza171097@gmail.com',   'password' => 'TO-AZWARA16', 'existing_account' => false],
        ['name' => 'khalil ahsan detakko',            'email' => 'olilhalil5@gmail.com',             'password' => 'TO-AZWARA17', 'existing_account' => false],
        ['name' => 'ELSA KUSUMA',                     'email' => 'elsakusuma2023@gmail.com',         'password' => 'TO-AZWARA18', 'existing_account' => false],
        ['name' => 'a.muh.rifat ghani',               'email' => 'rifatorkay@gmail.com',             'password' => 'TO-AZWARA19', 'existing_account' => false],
        ['name' => 'Muammar Khadafi',                 'email' => 'khadafimuammar08@gmail.com',       'password' => 'TO-AZWARA20', 'existing_account' => false],
        ['name' => 'KAYLA AZZAHRA UMAR',              'email' => 'umarkayla50@gmail.com',            'password' => 'TO-AZWARA21', 'existing_account' => false],
        ['name' => 'GHAZA RAIHANAN LAKSONO',          'email' => 'raihananlaksono@gmail.com',        'password' => 'TO-AZWARA22', 'existing_account' => false],
        ['name' => 'Indry Rahmadany',                 'email' => 'indryrahmadany73@gmail.com',       'password' => 'TO-AZWARA23', 'existing_account' => false],
        ['name' => 'kucing gemuk',                    'email' => 'felishaindira406@gmail.com',       'password' => 'TO-AZWARA24', 'existing_account' => false],
        ['name' => 'As-salam',                        'email' => 'ikbalsaputra361994@gmail.com',     'password' => 'TO-AZWARA25', 'existing_account' => false],
        ['name' => 'Grace Sianturi',                  'email' => 'gracesianturi83@gmail.com',        'password' => 'TO-AZWARA26', 'existing_account' => false],
        ['name' => 'NADZWA ALILATUL MUKHBITAH',       'email' => 'nadzwaalilatulmukhbitah@gmail.com','password' => 'TO-AZWARA27', 'existing_account' => false],
        ['name' => 'christmas angel',                 'email' => 'simbolonangel78@gmail.com',        'password' => 'TO-AZWARA28', 'existing_account' => false],
        ['name' => 'Zahwa',                           'email' => 'nurfiahchaeranizahwa@gmail.com',   'password' => 'TO-AZWARA29', 'existing_account' => false],
        ['name' => 'Okom Deantara',                   'email' => 'rfkbrc@gmail.com',                 'password' => 'TO-AZWARA30', 'existing_account' => false],
        ['name' => 'Naofal Fitrah Khairullah',        'email' => 'naofalfitrahsertifikat@gmail.com', 'password' => 'TO-AZWARA31', 'existing_account' => false],
        ['name' => 'Nadia Meila Putri',               'email' => 'nadiameila2728@gmail.com',         'password' => 'TO-AZWARA32', 'existing_account' => false],
        ['name' => 'Bevan Pramudito',                 'email' => 'bevantab01@gmail.com',             'password' => 'TO-AZWARA33', 'existing_account' => false],
        ['name' => "Nur Faizah Firadhatul Nafi'ah",   'email' => 'firadhatulnafiah@gmail.com',       'password' => 'TO-AZWARA34', 'existing_account' => false],
        ['name' => 'Sheren Putri Pongkapadang',       'email' => 'sherenpongkapadang@gmail.com',     'password' => 'TO-AZWARA35', 'existing_account' => false],
        ['name' => 'Gentur Topo Aji',                 'email' => 'genturtopoaji123@gmail.com',       'password' => 'TO-AZWARA36', 'existing_account' => false],
        ['name' => 'Shafeliani Anjali',               'email' => 'shafelianifeli@gmail.com',         'password' => 'TO-AZWARA37', 'existing_account' => false],
        ['name' => 'Humaira Iswara (ayi)',             'email' => 'humairaiswara3@gmail.com',         'password' => 'TO-AZWARA38', 'existing_account' => false],
        ['name' => 'Aufa Zaskia',                     'email' => 'aufazaskia04@gmail.com',           'password' => 'TO-AZWARA39', 'existing_account' => false],
        ['name' => 'FITRIA',                          'email' => 'if5040444@gmail.com',              'password' => 'TO-AZWARA40', 'existing_account' => false],
        ['name' => 'Ummul Khairunnisa',               'email' => 'ummulkhairunnisa123@gmail.com',    'password' => 'TO-AZWARA41', 'existing_account' => false],
        ['name' => 'Azzahra Putriyoza',               'email' => 'azzahraputriyoza07@gmail.com',     'password' => 'TO-AZWARA42', 'existing_account' => false],
        ['name' => 'ARIF BUDIMAN',                    'email' => 'arifbudiman097@gmail.com',         'password' => 'TO-AZWARA43', 'existing_account' => false],
        ['name' => 'Putri Disi Mayshaluna',           'email' => 'disimayshaluna@gmail.com',         'password' => 'TO-AZWARA44', 'existing_account' => false],
        ['name' => 'Amara Fitrany',                   'email' => 'amarafitranyy@gmail.com',          'password' => 'TO-AZWARA45', 'existing_account' => false],
        ['name' => 'Aulia Hawin Alaina Effendi',      'email' => 'auliahawin5@gmail.com',            'password' => 'TO-AZWARA46', 'existing_account' => false],
        ['name' => 'Vidi Wilujeng Oktaviany',         'email' => 'rholasmanam5474@gmail.com',        'password' => 'TO-AZWARA47', 'existing_account' => false],
        ['name' => 'Adnan Lubis',                     'email' => 'adnanlubisaaa@gmail.com',          'password' => 'TO-AZWARA48', 'existing_account' => false],
        ['name' => 'Marsya',                          'email' => 'marsyamarsha27@gmail.com',         'password' => 'TO-AZWARA49', 'existing_account' => false],
        ['name' => 'Salsabilla rakhma alifiani',      'email' => 'salsabilaalifiani512@gmail.com',   'password' => 'TO-AZWARA50', 'existing_account' => false],
        ['name' => 'Ran Mouri',                       'email' => 'daniharira1@gmail.com',            'password' => 'TO-AZWARA51', 'existing_account' => false],
        ['name' => 'Fatur Rahman',                    'email' => 'tasyrifimam217@gmail.com',         'password' => 'TO-AZWARA52', 'existing_account' => false],
        ['name' => 'Rizi Rimbawan',                   'email' => 'budakalam26@gmail.com',            'password' => 'TO-AZWARA53', 'existing_account' => false],
        ['name' => 'Rizi Rimbawan',                   'email' => 'rimbawanrizi@gmail.com',           'password' => 'TO-AZWARA54', 'existing_account' => false],
        ['name' => 'Galang Rizqulah Rahendra',        'email' => 'galangrizqulahrahendra@gmail.com', 'password' => 'TO-AZWARA55', 'existing_account' => false],
        ['name' => 'Bismillah',                       'email' => 'aliongtarimus404@gmail.com',       'password' => 'TO-AZWARA56', 'existing_account' => false],
        ['name' => 'Joy Christian Sembiring',         'email' => 'joychristiansembiring@gmail.com',  'password' => 'TO-AZWARA57', 'existing_account' => false],
        ['name' => 'Ika Restu Wulandari',             'email' => 'wulandariikarestu@gmail.com',      'password' => 'TO-AZWARA58', 'existing_account' => false],
        ['name' => 'Adji',                            'email' => 'ayumyeishasm@gmail.com',           'password' => 'TO-AZWARA59', 'existing_account' => false],
        ['name' => 'm iqbal',                         'email' => 'iqbalhafizh28@gmail.com',          'password' => 'TO-AZWARA60', 'existing_account' => false],
        ['name' => 'Eowyn Putri Fiansyah',            'email' => 'owynputri@gmail.com',              'password' => 'TO-AZWARA61', 'existing_account' => false],
        ['name' => 'Syalwa Ria Harmonis',             'email' => 'syalwariaharmonis13@gmail.com',    'password' => 'TO-AZWARA62', 'existing_account' => false],
        ['name' => 'Diva Oktavia Rahmadani',          'email' => 'divaoktavia9amusago@gmail.com',    'password' => 'TO-AZWARA63', 'existing_account' => false],
        ['name' => 'Dzawata Afnan',                   'email' => 'dzawataafnan5548@gmail.com',       'password' => 'TO-AZWARA64', 'existing_account' => false],
    ];

    public function run(): void
    {
        $now = Carbon::now();

        $newUsers      = 0;
        $existingUsers = 0;
        $entitlements  = 0;

        foreach ($this->users as $data) {
            // Cek apakah email sudah ada di DB
            $existingUser = DB::table('users')->where('email', $data['email'])->first();

            if ($existingUser) {
                // ── Akun sudah ada: tandai di kolom existing_account ──
                // (flag di array hanya untuk dokumentasi, pengecekan nyata pakai query di atas)
                $userId = $existingUser->id;
                $existingUsers++;

                $this->command->warn("  [EXISTING] {$data['email']}");
            } else {
                // ── Buat user baru ──
                $userId = DB::table('users')->insertGetId([
                    'name'              => $data['name'],
                    'email'             => $data['email'],
                    'password'          => Hash::make($data['password']),
                    'is_active'         => 1,
                    'province_id'       => null,
                    'regency_id'        => null,
                    'phone'             => null,
                    'avatar'            => null,
                    'email_verified_at' => $now,
                    'created_at'        => $now,
                    'updated_at'        => $now,
                ]);
                $newUsers++;

                $this->command->info("  [NEW]      {$data['email']}");
            }

            // ── Buat entitlement (tryout #19, source purchase) ──
            // Hindari duplikasi: skip jika sudah ada entitlement yang sama
            $alreadyHasEntitlement = DB::table('user_entitlements')
                ->where('user_id',          $userId)
                ->where('entitlement_type', 'tryout')
                ->where('entitlement_id',   19)
                ->exists();

            if (! $alreadyHasEntitlement) {
                DB::table('user_entitlements')->insert([
                    'user_id'          => $userId,
                    'entitlement_type' => 'tryout',
                    'entitlement_id'   => 19,
                    'source'           => 'purchase',
                    'expires_at'       => null,
                    'created_at'       => $now,
                    'updated_at'       => $now,
                ]);
                $entitlements++;
            } else {
                $this->command->line("  [SKIP ENT] {$data['email']} — entitlement sudah ada");
            }
        }

        $this->command->newLine();
        $this->command->info("━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━");
        $this->command->info("  Selesai!");
        $this->command->info("  User baru dibuat    : {$newUsers}");
        $this->command->warn("  User sudah ada      : {$existingUsers}");
        $this->command->info("  Entitlement dibuat  : {$entitlements}");
        $this->command->info("━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━");
    }
}
