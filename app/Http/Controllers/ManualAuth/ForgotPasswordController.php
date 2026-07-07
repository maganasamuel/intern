<?php

namespace App\Http\Controllers\ManualAuth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Password;

class ForgotPasswordController extends Controller
{
    public function forgot_password_form()
    {
        return view('manual_auth.forgot-password', [
            'title' => 'Forgot Password',
        ]);
    }

    public function forgot_password()
    {
        request()->validate([
            'email' => ['required', 'string', 'email:rfc,dns'],
        ], [], [
            'email' => 'Email',
        ]);

        $status = Password::sendResetLink(
            request()->only('email')
        );

        return $status === Password::ResetLinkSent
            ? back()->with(['status' => __($status)])
            : back()
                ->withErrors(['email' => __($status)])
                ->withInput();
    }
}
