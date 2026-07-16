<?php

namespace App\Http\Controllers\Students;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class LoginController extends Controller
{
    public function form()
    {
        return view('student_auth.login', [
            'title' => 'Student Login',
        ]);
    }

    public function login()
    {
        $credentials = request()->validate([
            'email' => ['required', 'string', 'email'],
            'password' => ['required', 'string'],
            'remember' => ['nullable', 'boolean'],
        ], [], [
            'email' => 'Email',
            'password' => 'Password',
            'remember' => 'Remember me',
        ]);

        $remember = Arr::pull($credentials, 'remember');

        /* $credentials[] = function (Builder $query) {
            return $query->where('status', 'active');
        }; */

        /* if (auth()->attempt($credentials, $remember)) {
            request()->session()->regenerate();

            return to_route('home');
        } */

        if (auth('student')->attempt($credentials, $remember)) {
            request()->session()->regenerate();

            // return to_route('home');

            return redirect()->intended(route('student.index'));
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput(['email', 'remember']);
    }
}
