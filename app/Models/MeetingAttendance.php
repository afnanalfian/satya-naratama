<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class MeetingAttendance extends Model
{
    use HasFactory;

    public const STATUS_HADIR = 'hadir';
    public const STATUS_IZIN  = 'izin';
    public const STATUS_SAKIT = 'sakit';
    public const STATUS_ALPA  = 'alpa';

    public const STATUSES = [
        self::STATUS_HADIR => 'Hadir',
        self::STATUS_IZIN  => 'Izin',
        self::STATUS_SAKIT => 'Sakit',
        self::STATUS_ALPA  => 'Alpa',
    ];

    public const METHOD_SCAN   = 'scan';
    public const METHOD_MANUAL = 'manual';

    protected $fillable = [
        'meeting_id',
        'user_id',
        'is_present',
        'status',
        'method',
        'note',
        'marked_by',
        'marked_at',
    ];

    protected $casts = [
        'is_present' => 'boolean',
        'marked_at'  => 'datetime',
    ];

    protected static function booted()
    {
        // is_present selalu sinkron dengan status (kompatibilitas kode lama)
        static::saving(function (MeetingAttendance $attendance) {
            $attendance->is_present = $attendance->status === self::STATUS_HADIR;
        });
    }

    public function meeting()
    {
        return $this->belongsTo(Meeting::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function marker()
    {
        return $this->belongsTo(User::class, 'marked_by');
    }

    public function getStatusLabelAttribute(): string
    {
        return self::STATUSES[$this->status] ?? ucfirst((string) $this->status);
    }

    /**
     * Terlambat = scan lebih dari toleransi setelah jadwal mulai.
     */
    public function getIsLateAttribute(): bool
    {
        if ($this->status !== self::STATUS_HADIR || ! $this->marked_at || ! $this->meeting?->scheduled_at) {
            return false;
        }

        return $this->marked_at->gt(
            $this->meeting->scheduled_at->copy()->addMinutes(config('attendance.late_tolerance_minutes', 15))
        );
    }
}
