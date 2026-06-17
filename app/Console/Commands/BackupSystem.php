<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Carbon\Carbon;

class BackupSystem extends Command
{
    protected $signature = 'backup:system';
    protected $description = 'Backup database dan storage dengan rotasi 2 backup';

    public function handle()
    {
        $this->info('Memulai backup sistem...');

        // 1. Backup Database
        $this->backupDatabase();

        // 2. Backup Storage
        $this->backupStorage();

        // 3. Rotasi Backup (hapus backup lama)
        $this->rotateBackups();

        $this->info('Backup selesai!');
    }

    protected function backupDatabase()
    {
        $this->info('Membackup database...');

        $timestamp = Carbon::now()->format('Ymd_His');
        $filename = "backup_db_{$timestamp}.sql";
        $backupPath = storage_path("app/backups/{$filename}");

        // Buat directory jika belum ada
        if (!File::exists(storage_path('app/backups'))) {
            File::makeDirectory(storage_path('app/backups'), 0755, true);
        }

        // Dapatkan konfigurasi database
        $database = config('database.connections.mysql.database');
        $username = config('database.connections.mysql.username');
        $password = config('database.connections.mysql.password');
        $host = config('database.connections.mysql.host');

        // Command mysqldump
        $command = sprintf(
            'mysqldump --host=%s --user=%s --password=%s %s > %s',
            escapeshellarg($host),
            escapeshellarg($username),
            escapeshellarg($password),
            escapeshellarg($database),
            escapeshellarg($backupPath)
        );

        // Eksekusi command
        exec($command, $output, $returnVar);

        if ($returnVar === 0) {
            $this->info("Database berhasil di backup: {$filename}");

            // Kompres file SQL
            $this->compressFile($backupPath);

            // Hapus file SQL mentah
            File::delete($backupPath);
        } else {
            $this->error('Gagal backup database');
        }
    }

    protected function backupStorage()
    {
        $this->info('Membackup storage...');

        $timestamp = Carbon::now()->format('Ymd_His');
        $foldername = "backup_storage_{$timestamp}";
        $backupPath = storage_path("app/backups/{$foldername}");

        // Backup folder storage/app/public
        $storagePath = storage_path('app/public');

        if (File::exists($storagePath)) {
            // Salin semua file dari storage ke backup
            File::copyDirectory($storagePath, $backupPath);

            // Kompres folder
            $zipPath = storage_path("app/backups/{$foldername}.zip");
            $this->createZip($backupPath, $zipPath);

            // Hapus folder backup asli
            File::deleteDirectory($backupPath);

            $this->info("Storage berhasil di backup: {$foldername}.zip");
        }
    }

    protected function rotateBackups()
    {
        $this->info('Melakukan rotasi backup...');

        $backupDir = storage_path('app/backups');

        if (!File::exists($backupDir)) {
            return;
        }

        // Ambil semua file backup
        $files = File::files($backupDir);

        // Filter hanya file backup (zip dan sql.gz)
        $backupFiles = array_filter($files, function ($file) {
            $filename = $file->getFilename();
            return preg_match('/^backup_(db|storage)_.*\.(zip|gz)$/', $filename);
        });

        // Urutkan berdasarkan tanggal modifikasi (terlama ke terbaru)
        usort($backupFiles, function ($a, $b) {
            return $a->getMTime() - $b->getMTime();
        });

        // Hitung total backup
        $totalBackups = count($backupFiles);

        // Jika ada lebih dari 4 backup (2 set), hapus yang terlama
        if ($totalBackups > 4) {
            $filesToDelete = $totalBackups - 4; // Pertahankan 4 backup (2 set)

            for ($i = 0; $i < $filesToDelete; $i++) {
                $file = $backupFiles[$i];
                File::delete($file->getPathname());
                $this->info("Menghapus backup lama: {$file->getFilename()}");
            }
        }

        $this->info("Total backup tersimpan: " . count($backupFiles) . " file");
    }

    protected function compressFile($filePath)
    {
        $compressedPath = $filePath . '.gz';

        // Baca file
        $data = File::get($filePath);

        // Kompres dengan gzip
        $compressed = gzencode($data, 9);

        // Simpan file terkompresi
        File::put($compressedPath, $compressed);
    }

    protected function createZip($sourcePath, $zipPath)
    {
        $zip = new \ZipArchive();

        if ($zip->open($zipPath, \ZipArchive::CREATE) === TRUE) {
            $files = new \RecursiveIteratorIterator(
                new \RecursiveDirectoryIterator($sourcePath),
                \RecursiveIteratorIterator::LEAVES_ONLY
            );

            foreach ($files as $name => $file) {
                if (!$file->isDir()) {
                    $filePath = $file->getRealPath();
                    $relativePath = substr($filePath, strlen($sourcePath) + 1);

                    $zip->addFile($filePath, $relativePath);
                }
            }

            $zip->close();
            return true;
        }

        return false;
    }
}
