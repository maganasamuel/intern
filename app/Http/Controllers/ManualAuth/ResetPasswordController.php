<?php

namespace App\Http\Controllers\ManualAuth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Facades\{Hash, Password};
use Illuminate\Support\{Arr, Str};

class ResetPasswordController extends Controller
{
    public function reset_password_form($token)
    {
        $title = 'Reset Password';

        return view('manual_auth.reset-password', compact('title', 'token'));
    }

    public function reset_password()
    {
        $data = request()->validate([
            'token' => ['required'],
            'email' => ['required', 'email'],
            'password' => ['required', 'min:8', 'confirmed'],
        ], [], [
            'token' => 'Token',
            'email' => 'Email',
            'password' => 'Password',
        ]);

        $data = array_merge($data, request()->only('password_confirmation'));

        $status = Password::reset(
            $data,
            function (User $user, string $password) {
                $user->forceFill([
                    'password' => Hash::make($password),
                ])->setRememberToken(Str::random(60));

                $user->save();

                event(new PasswordReset($user));
            }
        );

        return $status === Password::PasswordReset
            ? redirect()->route('login')->with('status', __($status))
            : back()->withErrors(['email' => [__($status)]])
                ->withInput();
    }
}
