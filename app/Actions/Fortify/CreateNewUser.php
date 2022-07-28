<?php

namespace App\Actions\Fortify;

use App\Http\Controllers\UserRoleController;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use Laravel\Jetstream\Jetstream;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Validate and create a newly registered user.
     *
     * @param  array  $input
     * @return \App\Models\User
     */
    public function create(array $input)
    {
        Validator::make($input, [
            'name' => ['required', 'string', 'max:255'],
            'surname' => ['required', 'string', 'max:255'],
            'dni' => ['required', 'int', 'min:1000000', 'max:99999999', 'unique:users'],
            'country' => ['required', 'string', 'max:255'],
            'province' => ['required', 'string', 'max:255'],
            'city' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => $this->passwordRules(),
            'terms' => Jetstream::hasTermsAndPrivacyPolicyFeature() ? ['accepted', 'required'] : '',
        ])->validate();

        $userRoleController = new UserRoleController();

        $user = User::create([
            'name' => $input['name'],
            'surname' => $input['surname'],
            'dni' => $input['dni'],
            'country' => $input['country'],
            'province' => $input['province'],
            'city' => $input['city'],
            'email' => $input['email'],
            'password' => Hash::make($input['password']),
        ]);

        $userRoleController->store(User::max('id'));

        return $user;
    }
}
