<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use Carbon\Carbon;

class PurgeInactiveUsers extends Command
{
    /**
     * The name and signature of the console command.
     */
    protected $signature = 'users:purge-inactive
                            {--days=3 : Jumlah hari sejak akun dibuat}
                            {--dry-run : Hanya tampilkan data tanpa menghapus}';

    /**
     * The console command description.
     */
    protected $description = 'Hard delete user yang belum verifikasi email lebih dari X hari';

    public function handle(): int
    {
        $days = (int) $this->option('days');
        $dryRun = $this->option('dry-run');

        $cutoff = Carbon::now()->subDays($days);

        $query = User::whereNull('email_verified_at')
            ->where('created_at', '<=', $cutoff);

        $count = $query->count();

        if ($count === 0) {
            $this->info('Tidak ada user yang perlu dihapus.');
            return self::SUCCESS;
        }

        $this->info("Ditemukan {$count} user tidak aktif (>{$days} hari).");

        if ($dryRun) {
            $this->warn('DRY RUN MODE — tidak ada data yang dihapus.');
            $query->select('id', 'email', 'created_at')->get()->each(function ($user) {
                $this->line("• {$user->email} | dibuat: {$user->created_at}");
            });
            return self::SUCCESS;
        }

        DB::transaction(function () use ($query) {
            $users = $query->get();

            foreach ($users as $user) {
                // Hapus session user
                DB::table('sessions')->where('user_id', $user->id)->delete();

                // Hapus reset password token
                DB::table('password_reset_tokens')->where('email', $user->email)->delete();

                // HARD DELETE user
                $user->forceDelete();
            }
        });

        $this->info("Berhasil menghapus {$count} user tidak aktif.");

        return self::SUCCESS;
    }
}
