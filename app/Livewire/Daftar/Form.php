<?php

namespace App\Livewire\Daftar;

use App\Models\Invoice;
use App\Models\Kecamatan;
use App\Models\Kelurahan;
use App\Models\StudentRegistration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithFileUploads;

#[Layout('components.layouts.public')]
#[Title('Pendaftaran Siswa Bimbel')]
class Form extends Component
{
    use WithFileUploads;

    public int $step = 1;

    public $full_name = '', $nickname = '', $birth_date = '', $gender = '', $school_origin = '', $class = '', $phone = '', $shirt_size = '';
    public $kecamatan_id = '', $kelurahan_id = '', $height_cm = '', $weight_kg = '';
    public $priority_university_1 = '', $priority_university_2 = '';
    public $parent_name = '', $parent_occupation = '', $parent_phone = '';
    public $email = '', $password = '', $password_confirmation = '';
    public $avatar;
    public bool $agree = false;

    protected function stepRules(int $step): array
    {
        $unis = implode(',', config('satya.universities'));

        return match ($step) {
            1 => [
                'full_name' => 'required|string|max:191',
                'nickname' => 'nullable|string|max:100',
                'birth_date' => 'required|date|before:today|after:1950-01-01',
                'gender' => 'required|in:L,P',
                'school_origin' => 'required|string|max:255',
                'class' => 'required|in:X,XI,XII,Alumni',
                'phone' => 'required|string|max:20|regex:/^[0-9]+$/',
                'shirt_size' => 'nullable|in:S,M,L,XL,XXL',
                'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            ],
            2 => [
                'kecamatan_id' => 'required|exists:kecamatans,id',
                'kelurahan_id' => 'required|exists:kelurahans,id',
                'height_cm' => 'nullable|integer|min:50|max:300',
                'weight_kg' => 'nullable|integer|min:10|max:500',
            ],
            3 => [
                'priority_university_1' => "required|in:$unis",
                'priority_university_2' => "nullable|in:$unis|different:priority_university_1",
                'parent_name' => 'required|string|max:191',
                'parent_occupation' => 'nullable|string|max:255',
                'parent_phone' => 'required|string|max:20|regex:/^[0-9]+$/',
            ],
            default => [
                'email' => 'required|email|max:191|unique:student_registrations,email|unique:users,email',
                'password' => 'required|string|min:8|confirmed',
                'password_confirmation' => 'required|string|min:8',
                'agree' => 'accepted',
            ],
        };
    }

    protected function messages(): array
    {
        return [
            'phone.regex' => 'Nomor WhatsApp harus berupa angka.',
            'parent_phone.regex' => 'Nomor telepon orang tua harus berupa angka.',
            'email.unique' => 'Email sudah terdaftar.',
            'password.min' => 'Password minimal 8 karakter.',
            'password.confirmed' => 'Konfirmasi password tidak cocok.',
            'agree.accepted' => 'Centang persetujuan untuk melanjutkan.',
            'priority_university_2.different' => 'Pilihan kedua harus berbeda dengan pilihan pertama.',
        ];
    }

    protected function validationAttributes(): array
    {
        return [
            'full_name' => 'nama lengkap', 'birth_date' => 'tanggal lahir', 'gender' => 'jenis kelamin', 'school_origin' => 'asal sekolah',
            'class' => 'kelas', 'phone' => 'nomor WhatsApp', 'kecamatan_id' => 'kecamatan', 'kelurahan_id' => 'kelurahan/desa',
            'height_cm' => 'tinggi badan', 'weight_kg' => 'berat badan', 'priority_university_1' => 'kampus impian 1',
            'parent_name' => 'nama orang tua', 'parent_phone' => 'nomor orang tua', 'password_confirmation' => 'konfirmasi password',
        ];
    }

    public function updatedKecamatanId()
    {
        $this->kelurahan_id = '';
    }

    public function next()
    {
        $this->validate($this->stepRules($this->step));
        $this->step = min(4, $this->step + 1);
        $this->dispatch('scroll-top');
    }

    public function back()
    {
        $this->step = max(1, $this->step - 1);
    }

    public function goTo(int $step)
    {
        if ($step < $this->step) {
            $this->step = $step;
        }
    }

    public function submit()
    {
        foreach ([1, 2, 3, 4] as $s) {
            try {
                $this->validate($this->stepRules($s));
            } catch (\Illuminate\Validation\ValidationException $e) {
                $this->step = $s;
                throw $e;
            }
        }

        $fee = config('satya.registration_fee', 6000000);

        $registration = DB::transaction(function () use ($fee) {
            $registration = StudentRegistration::create([
                'full_name' => $this->full_name,
                'nickname' => $this->nickname ?: null,
                'birth_date' => $this->birth_date,
                'gender' => $this->gender,
                'school_origin' => $this->school_origin,
                'shirt_size' => $this->shirt_size ?: null,
                'class' => $this->class,
                'phone' => $this->phone,
                'kecamatan_id' => $this->kecamatan_id,
                'kelurahan_id' => $this->kelurahan_id,
                'height_cm' => $this->height_cm ?: null,
                'weight_kg' => $this->weight_kg ?: null,
                'priority_university_1' => $this->priority_university_1,
                'priority_university_2' => $this->priority_university_2 ?: null,
                'parent_name' => $this->parent_name,
                'parent_occupation' => $this->parent_occupation ?: null,
                'parent_phone' => $this->parent_phone,
                'email' => $this->email,
                'password' => Hash::make($this->password),
                'avatar' => $this->avatar ? $this->avatar->store('avatars/pendaftaran', 'public') : null,
                'registration_fee' => $fee,
                'payment_status' => 'pending',
                'ip_address' => request()->ip(),
                'user_agent' => request()->userAgent(),
                'registration_status' => 'pending_payment',
            ]);

            Invoice::create([
                'registration_id' => $registration->id,
                'invoice_number' => Invoice::generateNumber(),
                'amount' => $fee,
                'description' => 'Biaya Pendaftaran Satya Naratama - '.$registration->full_name,
                'status' => 'pending',
            ]);

            return $registration;
        });

        toast('success', 'Pendaftaran berhasil! Silakan lakukan pembayaran.');

        return $this->redirectRoute('daftar.payment', $registration->id);
    }

    public function render()
    {
        return view('livewire.daftar.form', [
            'kecamatans' => Kecamatan::where('regency_id', 7309)->orderBy('name')->get(['id', 'name']),
            'kelurahans' => $this->kecamatan_id ? Kelurahan::where('kecamatan_id', $this->kecamatan_id)->orderBy('name')->get(['id', 'name']) : collect(),
            'universities' => config('satya.universities'),
            'classes' => config('satya.classes'),
            'sizes' => config('satya.shirt_sizes'),
        ]);
    }
}
