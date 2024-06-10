<?php

namespace App\Actions\Fortify;

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
     * @param  array<string, string>  $input
     */
    public function create(array $input): User
    {
        if (1 || request()->wantsJson()) {
            $roles = \App\Models\Role::where('name','!=',config('constants.superadmin_role'))->where('is_for_client',1)->get()->pluck('name');
        } else {
            $roles = \App\Models\Role::where('name','!=',config('constants.superadmin_role'))->where('is_for_admin',1)->get()->pluck('name');
        }
        Validator::make($input, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => $this->passwordRules(),
            'terms' => Jetstream::hasTermsAndPrivacyPolicyFeature() ? ['accepted', 'required'] : '',
            'role' => ['required', 'string', 'max:20',\Illuminate\Validation\Rule::in($roles)],
        ])->validate();

        $user = User::create([
            'name' => $input['name'],
            'email' => $input['email'],
            'password' => Hash::make($input['password'])
            //'status' => 1 //(request()->wantsJson()?1:0)
        ]);
        $userRole = $user->assignRole($input['role']);
        return $user;
    }
}
