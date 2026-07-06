<?php

namespace App\Http\Controllers\ManualAuth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function form()
    {
        return view('manual_auth.login', [
            'title' => 'Login',
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

        if (Auth::attemptWhen($credentials, function (User $user) {
            return $user->status == 'active';
        }, $remember)) {
            request()->session()->regenerate();

            // return to_route('home');

            return redirect()->intended(route('home'));
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput(['email', 'remember']);
    }

    public function login_by_id($id)
    {
        // auth()->loginUsingId($id);

        $user = User::findOrFail($id);

        auth()->login($user);

        return to_route('home');
    }

    public function logout()
    {
        auth()->logout();

        request()->session()->invalidate();

        request()->session()->regenerateToken();

        return redirect('/');
    }
}
