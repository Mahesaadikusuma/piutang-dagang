<?php

namespace App\Livewire\Admin;

use App\Models\District;
use App\Models\Province;
use App\Models\Regency;
use App\Models\Setting as Settings;
use App\Models\User;
use App\Models\Village;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\WithFileUploads;
use phpDocumentor\Reflection\Types\Boolean;
use Masmerise\Toaster\Toaster;

#[Layout('layouts.dashboard')]
#[Title('Setting')]
class Setting extends Component
{   
    use WithFileUploads;

    public User $user;
    public Settings $setting;

    #[Validate()] 
    public ?String $username;
    public ?String $email;
    public ?String $fullName;
    public ?String $phoneNumber;

    public ?int $provinceID = null;
    public ?int $regencyID = null;
    public ?int $districtID = null;
    public ?int $villageID = null;

    public bool $isComplete = true;

    public ?String $address;
    public $avatar;

    public function mount()
    {
        $this->user = Auth::user();
        $this->username = $this->user->name;
        $this->email = $this->user->email;

        $this->setting = Settings::firstOrNew(['user_id' => $this->user->id]);
        $this->fullName = $this->setting->full_name;
        $this->phoneNumber = $this->setting->phone_number;
        $this->provinceID = $this->setting->province_id;
        $this->regencyID = $this->setting->regency_id;
        $this->districtID = $this->setting->district_id;
        $this->villageID = $this->setting->village_id;
        $this->address = $this->setting->address;
    }

    #[Computed()]
    public function provinces()
    {
        return Province::all();
    }

    #[Computed()]
    public function regencies()
    {
        return Regency::where('province_id', $this->provinceID)->get();
    }

    #[Computed()]
    public function districts()
    {
        return District::where('regency_id', $this->regencyID)->get();
    }

    #[Computed()]
    public function villages()
    {
        return Village::where('district_id', $this->districtID)->get();
    }

    public function updatedProvinceID($value)
    {
        $this->regencyID = null;
        $this->districtID = null;
        $this->villageID = null;
    }

    public function updatedRegencyID($value)
    {
        $this->districtID = null;
        $this->villageID = null;
    }

    public function updatedDistrictID($value)
    {
        $this->villageID = null;
    }

    // public function removeTMP(){
    //     $oldFile = Storage::files('livewire-tmp');

    //     foreach ($oldFile as $file) {
    //         Storage::delete($file);
    //     }
    //     session()->flash('success', 'File livewire-tmp Deleted');
    //     return $this->redirect('/Admin/product', navigate:true);
    // }    
    
    protected $rules = [
        'username' => 'required|string|min:3|max:50',
        'fullName' => 'required|string|min:3|max:255',
        'phoneNumber' => 'required|numeric|min_digits:10|max_digits:13',
        'provinceID' => 'required|exists:provinces,id',
        'regencyID' => 'required|exists:regencies,id',
        'districtID' => 'required|exists:districts,id',
        'villageID' => 'required|exists:villages,id',
        'address' => 'required|string|max:500',
        'avatar' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
    ];

    protected $messages = [
        'username.required' => 'Nama User harus diisi',
        'username.min' => 'Nama User harus minimal 3 karakter',
        'username.max' => 'Nama User harus maximal 50 karakter',
        'fullName.required' => 'Nama Lengkap harus diisi',
        'fullName.min' => 'Nama Lengkap harus minimal 3 karakter',
        'fullName.max' => 'Nama Lengkap harus maximal 50 karakter',
        'phoneNumber.required' => 'Nomor Telepon harus diisi',
        'phoneNumber.min_digits' => 'Nomor Telepon minimal 10 digit',
        'phoneNumber.max_digits' => 'Nomor Telepon maximal 13 digit',
        'provinceID.required' => 'Provinsi harus dipilih',
        'regencyID.required' => 'Kabupaten/Kota harus dipilih',
        'districtID.required' => 'Kecamatan harus dipilih',
        'villageID.required' => 'Kelurahan harus dipilih',
        'address.required' => 'Alamat harus diisi',
        'avatar.image' => 'Avatar harus berupa gambar dengan format jpg, jpeg, atau png',
        'avatar.max' => 'Avatar harus berukuran maksimal 2MB',
    ];

    public function save()
    {
        try {
            $this->validate();

            $data = [ 
                'user_id' => $this->user->id,
                'username' => $this->username,
                'full_name' => $this->fullName,
                'email' => $this->email,
                'phone_number' => $this->phoneNumber,
                'address' => $this->address,
                "is_complete" => $this->isComplete,
                'province_id' => $this->provinceID,
                'regency_id' => $this->regencyID,
                'district_id' => $this->districtID,
                'village_id' => $this->villageID,
            ];

            if ($this->avatar) {
                $imagePath = $this->avatar->storeAs('setting/avatar', $this->avatar->hashName(), 'public');
                $data['avatar'] = $imagePath;
            }

            $settingActive = Settings::where('user_id', $this->user->id)->first();

            if ($settingActive) {
                $this->setting->update($data);
                Toaster::success('Informasi Telah di Update!');
            } else {
                Settings::create($data);
                Toaster::success('Informasi Telah di create!');
            }
        } catch (Exception $e) {
             Toaster::error('valida: ' . $e->getMessage());
        }
    }

    public function render()
    {
        return view('livewire.admin.setting');
    }
}
