<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use App\Models\AccountDeletionLog;
use Carbon\Carbon;

class DeleteExpiredAccounts extends Command
{
    protected $signature = 'accounts:purge';
    protected $description = 'Menghapus akun yang dinonaktifkan lebih dari 10 hari';

    public function handle()
    {
        $threshold = Carbon::now()->subDays(10);

        // ambil log yang deactivated_at >= 10 hari lalu dan belum dihapus
        $logs = AccountDeletionLog::whereNull('deleted_at')
            ->where('deactivated_at', '<=', $threshold)
            ->get();

        if ($logs->isEmpty()) {
            $this->info("Tidak ada akun yang perlu dihapus.");
            return;
        }

        foreach ($logs as $log) {

            $user = User::find($log->user_id);

            if (!$user) {
                // user sudah hilang atau foreign key cascade
                $log->update(['deleted_at' => now()]);
                continue;
            }

            // hapus user permanen
            $user->delete();

            // update log
            $log->update([
                'deleted_at' => now(),
            ]);

            $this->info("Akun {$log->user_id} dihapus permanen.");
        }
    }
}
