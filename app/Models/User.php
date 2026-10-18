<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use App\Notifications\ResetPasswordNotification;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

/**
 * @method bool hasRole(string|int|array|\Spatie\Permission\Models\Role|\Illuminate\Support\Collection|\BackedEnum $roles, string|null $guard = null)
 */

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    protected $fillable = [
        'name',
        'email',
        'password',
        'phone',
        'avatar',
        'province_id',
        'regency_id',
        'is_active',
        'email_verified_at',
        'last_verification_sent_at',
    ];

    protected $hidden = ['password', 'remember_token', 'qr_token', 'parent_token'];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'last_verification_sent_at' => 'datetime',
        'is_active' => 'boolean',
    ];
    /* =====================================================
     | TOKENS: QR ABSENSI & LINK PANTAUAN ORANG TUA
     |===================================================== */

    protected static function booted()
    {
        static::creating(function (User $user) {
            $user->qr_token     ??= self::newQrToken();
            $user->parent_token ??= self::newParentToken();
        });
    }

    public static function newQrToken(): string
    {
        do {
            $token = Str::upper(Str::random(24));
        } while (self::where('qr_token', $token)->exists());

        return $token;
    }

    public static function newParentToken(): string
    {
        do {
            $token = Str::random(40);
        } while (self::where('parent_token', $token)->exists());

        return $token;
    }

    /** Pastikan token ada (untuk user lama yang belum ter-backfill). */
    public function ensureTokens(): self
    {
        $dirty = false;
        if (! $this->qr_token) {
            $this->qr_token = self::newQrToken();
            $dirty = true;
        }
        if (! $this->parent_token) {
            $this->parent_token = self::newParentToken();
            $dirty = true;
        }
        if ($dirty) {
            $this->saveQuietly();
        }

        return $this;
    }

    /** Isi QR code pada kartu siswa. */
    public function getQrPayloadAttribute(): string
    {
        $this->ensureTokens();

        return config('attendance.qr_prefix', 'SN-') . $this->qr_token;
    }

    /** Link publik untuk orang tua (tanpa login). */
    public function getParentMonitorUrlAttribute(): string
    {
        $this->ensureTokens();

        return route('parent.monitor', $this->parent_token);
    }

    /** L / P dari data pendaftaran (null jika tidak ada). */
    public function getGenderAttribute(): ?string
    {
        return $this->studentRegistration?->gender;
    }

    public function getDisplayNameAttribute(): string
    {
        return $this->studentRegistration?->full_name ?: $this->name;
    }

    public function physicalRecords()
    {
        return $this->hasMany(StudentPhysicalRecord::class)->orderBy('period');
    }

    public function physicalEvaluationResults()
    {
        return $this->hasMany(PhysicalEvaluationResult::class);
    }

    public function scopeActiveStudents($query)
    {
        return $query->role('siswa')->where('is_active', true);
    }

    public function getWhatsappPhoneAttribute(): ?string
    {
        if (empty($this->phone)) {
            return null;
        }

        $phone = trim($this->phone);

        // Hapus spasi, strip, dll
        $phone = preg_replace('/[^0-9]/', '', $phone);

        // Jika diawali 0 → ganti 62
        if (str_starts_with($phone, '0')) {
            return '62' . substr($phone, 1);
        }

        // Jika sudah diawali 62
        if (str_starts_with($phone, '62')) {
            return $phone;
        }

        // Jika pakai +62 (harusnya sudah hilang + di regex)
        if (str_starts_with($phone, '62')) {
            return $phone;
        }

        // Fallback (anggap sudah benar)
        return $phone;
    }

    public function province()
    {
        return $this->belongsTo(Province::class);
    }
    public function teacher()
    {
        return $this->hasOne(Teacher::class);
    }
    public function regency()
    {
        return $this->belongsTo(Regency::class);
    }
    public function cart()
    {
        return $this->hasOne(Cart::class)->where('status', 'active');
    }
    public function attendances()
    {
        return $this->hasMany(MeetingAttendance::class);
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }
    public function examAttempts()
    {
        return $this->hasMany(ExamAttempt::class);
    }
    public function entitlements()
    {
        return $this->hasMany(UserEntitlement::class);
    }

    public function sendEmailVerificationNotification()
    {
        $this->notify(new \App\Notifications\CustomVerifyEmail);
    }
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ResetPasswordNotification($token));
    }
    public function getAvatarUrlAttribute()
    {
        return $this->avatar && Storage::disk('public')->exists($this->avatar)
            ? asset('storage/'.$this->avatar)
            : asset('img/user.png');
    }
    public function studentRegistration()
    {
        return $this->hasOne(StudentRegistration::class);
    }
    /* =====================================================
     | GENERIC HELPERS
     |===================================================== */

    public function hasEntitlement(string $type, ?int $id = null): bool
    {
        return $this->entitlements()
            ->where('entitlement_type', $type)
            ->when(
                ! is_null($id),
                fn ($q) => $q->where('entitlement_id', $id)
            )
            ->exists();
    }

    public function entitlementIds(string $type): array
    {
        return $this->entitlements()
            ->where('entitlement_type', $type)
            ->pluck('entitlement_id')
            ->filter()
            ->values()
            ->toArray();
    }

    /* =====================================================
     | DOMAIN SHORTCUTS
     |===================================================== */

    public function hasCourse(int $courseId): bool
    {
        return $this->hasEntitlement('course', $courseId);
    }

    public function ownedCourseIds(): array
    {
        return $this->entitlementIds('course');
    }

    public function ownedMeetingIds(): array
    {
        return $this->entitlementIds('meeting');
    }

    /**
     * Tryout
     */
    public function hasTryoutAccess(int $tryoutId): bool
    {
        return $this->hasEntitlement('tryout', $tryoutId);
    }
    public function ownedTryoutIds(): array
    {
        return $this->entitlements()
            ->where('entitlement_type', 'tryout')
            ->pluck('entitlement_id')
            ->toArray();
    }
    /**
     * Quiz bersifat GLOBAL
     */
    public function hasQuizAccess(): bool
    {
        return $this->hasEntitlement('quiz');
    }

    public static function usersWithMeetingAccess(Meeting $meeting)
    {
        return User::whereHas('entitlements', function ($q) use ($meeting) {
            $q->where(function ($q2) use ($meeting) {
                $q2->where('entitlement_type', 'meeting')
                ->where('entitlement_id', $meeting->id);
            })->orWhere(function ($q2) use ($meeting) {
                $q2->where('entitlement_type', 'course')
                ->where('entitlement_id', $meeting->course_id);
            });
        })->get();
    }
}
