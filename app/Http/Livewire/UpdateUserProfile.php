<?php

namespace App\Http\Livewire;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Livewire\Component;
use Livewire\WithFileUploads;

class UpdateUserProfile extends Component
{
    use WithFileUploads;

    public $user;
    public $verificationLinkSent;
    public $state;
    public $photo;

    public $name;
    public $surname;
    public $dni;
    public $email;
    public $country;
    public $province;
    public $city;
    public $profile_photo_path;
    public $profile_photo_url;

    protected $rules = [
        'name' => ['required', 'string', 'max:255'],
        'surname' => ['required', 'string', 'max:255'],
        // 'dni' => ['required', 'integer', 'min:1000000', 'max:99999999', Rule::unique('users')->ignore($user->id)],
        'country' => ['required', 'string', 'max:255'],
        'province' => ['required', 'string', 'max:255'],
        'city' => ['required', 'string', 'max:255'],
        // 'email' => ['required', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
        'photo' => ['nullable', 'mimes:jpg,jpeg,png', 'max:3072'],
    ];

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function update()
    {
        $validatedData = $this->validate();
        $user = new User();
        $user->forceFill($validatedData);
    }

    public function render()
    {
        $this->user = Auth::user();
        // $this->state = [
        //     "id" => $this->user->id,
        //     "name" => $this->user->name,
        //     "surname" => $this->user->surname,
        //     "dni" => $this->user->dni,
        //     "email" => $this->user->email,
        //     "email_verified_at" => $this->user->email_verified_at,
        //     "two_factor_confirmed_at" => $this->user->two_factor_confirmed_at,
        //     "country" => $this->user->country,
        //     "province" => $this->user->province,
        //     "city" => $this->user->city,
        //     "profile_photo_path" => $this->user->profile_photo_path,
        //     "created_at" => $this->user->created_at,
        //     "updated_at" => $this->user->updated_at,
        //     "profile_photo_url" => $this->user->profile_photo_url
        // ];
        $this->name = $this->user->name;
        $this->surname = $this->user->surname;
        $this->dni = $this->user->dni;
        $this->email = $this->user->email;
        $this->country = $this->user->country;
        $this->province = $this->user->province;
        $this->city = $this->user->city;
        $this->profile_photo_path = $this->user->profile_photo_path;
        $this->profile_photo_url = $this->user->profile_photo_url;

        return view('livewire.update-user-profile');
    }
}
