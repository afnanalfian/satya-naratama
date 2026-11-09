<?php

namespace App\Livewire\Profile;

use App\Models\Kecamatan;
use App\Models\Kelurahan;
use App\Models\Province;
use App\Models\Regency;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithFileUploads;

#[Title('Ubah Profil')]
class Edit extends Component
{
    use WithFileUploads;

    public $name, $phone, $province_id, $regency_id, $avatar;
    public array $reg = [];
    public bool $hasRegistration = false;

    protected array $regFields = ['full_name', 'nickname', 'birth_date', 'gender', 'school_origin', 'class', 'phone', 'kecamatan_id', 'kelurahan_id',
        'height_cm', 'weight_kg', 'shirt_size', 'priority_university_1', 'priority_university_2', 'parent_name', 'parent_occupation', 'parent_phone'];

    public function mount()
    {
        $u = auth()->user();
        $this->fill($u->only('name', 'phone', 'province_id', 'regency_id'));
        if ($u->hasRole('siswa') && $u->studentRegistration) {
            $this->hasRegistration = true;
            $r = $u->studentRegistration;
            foreach ($this->regFields as $f) {
                $this->reg[$f] = $f === 'birth_date' ? $r->birth_date?->format('Y-m-d') : ($r->{$f} ?? '');
            }
        }
    }

    public function updatedProvinceId() { $this->regency_id = ''; }
    public function updatedRegKecamatanId() { $this->reg['kelurahan_id'] = ''; }

    public function save()
    {
        $unis = implode(',', config('satya.universities'));
        $rules = [
            'name' => 'required|string|max:255',
            'phone' => 'nullable|string|max:20',
            'province_id' => 'nullable|exists:provinces,id',
            'regency_id' => 'nullable|exists:regencies,id',
            'avatar' => 'nullable|image|max:2048',
        ];
        if ($this->hasRegistration) {
            $rules += [
                'reg.full_name' => 'required|string|max:191', 'reg.nickname' => 'nullable|string|max:100',
                'reg.birth_date' => 'nullable|date|before:today', 'reg.gender' => 'nullable|in:L,P',
                'reg.school_origin' => 'nullable|string|max:255', 'reg.class' => 'nullable|in:X,XI,XII,Alumni',
                'reg.phone' => 'nullable|string|max:20', 'reg.kecamatan_id' => 'nullable|exists:kecamatans,id',
                'reg.kelurahan_id' => 'nullable|exists:kelurahans,id', 'reg.height_cm' => 'nullable|integer|min:50|max:300',
                'reg.weight_kg' => 'nullable|integer|min:10|max:500', 'reg.shirt_size' => 'nullable|in:S,M,L,XL,XXL',
                'reg.priority_university_1' => "nullable|in:$unis", 'reg.priority_university_2' => "nullable|in:$unis",
                'reg.parent_name' => 'nullable|string|max:191', 'reg.parent_occupation' => 'nullable|string|max:255', 'reg.parent_phone' => 'nullable|string|max:20',
            ];
        }
        $this->validate($rules, [], ['name' => 'nama', 'reg.full_name' => 'nama lengkap']);

        $u = auth()->user();
        $data = ['name' => $this->name, 'phone' => $this->phone ?: null];
        if ($this->province_id) {
            $data['province_id'] = $this->province_id;
            $data['regency_id'] = $this->regency_id ?: null;
        }
        if ($this->avatar) {
            $data['avatar'] = $this->avatar->store('avatars', 'public');
        }
        $u->update($data);

        if ($this->hasRegistration && $u->studentRegistration) {
            $payload = collect($this->reg)->only($this->regFields)->filter(fn ($v) => $v !== '' && $v !== null)->all();
            $u->studentRegistration->update($payload);
        }

        toast('success', 'Profil berhasil diperbarui.');
        return $this->redirectRoute('profile.show');
    }

    public function render()
    {
        return view('livewire.profile.edit', [
            'provinces' => Province::orderBy('name')->get(['id', 'name']),
            'regencies' => $this->province_id ? Regency::where('province_id', $this->province_id)->orderBy('name')->get(['id', 'name']) : collect(),
            'kecamatans' => $this->hasRegistration ? Kecamatan::where('regency_id', 7309)->orderBy('name')->get(['id', 'name']) : collect(),
            'kelurahans' => ! empty($this->reg['kecamatan_id']) ? Kelurahan::where('kecamatan_id', $this->reg['kecamatan_id'])->orderBy('name')->get(['id', 'name']) : collect(),
        ]);
    }
}
