<?php

namespace App\Actions\Fortify;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\UpdatesUserPasswords;
use Masmerise\Toaster\Toaster;

class UpdateUserPassword implements UpdatesUserPasswords
{
    use PasswordValidationRules;

    /**
     * Validate and update the user's password.
     *
     * @param  array<string, string>  $input
     */
    public function update(User $user, array $input): void
    {
        Validator::make($input, [
            'current_password' => ['required', 'string', 'current_password:web'],
            'password' => $this->passwordRules(),
            'password_confirmation' => ['required', 'string', 'same:password'],
        ], [
            'current_password.required' => __('Kata sandi saat ini harus diisi.'),
            'current_password.current_password' => __('Kata sandi yang diberikan tidak cocok dengan kata sandi Anda saat ini..'),
            'password.required' => __('Kata sandi baru harus diisi.'),
            'password.min' => __('Kata sandi baru minimum harus 8 karakter.'),
            'password_confirmation.required' => __('Konfirmasi kata sandi harus diisi.'),
            'password_confirmation.same' => __('Konfirmasi kata sandi tidak cocok dengan kata sandi baru.'),
        ])->validateWithBag('updatePassword');

        $user->forceFill([
            'password' => Hash::make($input['password']),
        ])->save();
        Toaster::success('Change Password Success!');
    }
}
