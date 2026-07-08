<?php

use App\Http\Controllers\ManualAuth\{ForgotPasswordController, LoginController, ResetPasswordController};
use App\Http\Controllers\StudentController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::redirect('/', 'home');

// Auth::routes();

Route::middleware(['guest'])
    ->group(function () {
        Route::controller(LoginController::class)
            ->group(function () {
                Route::prefix('login')
                    ->name('login')
                    ->group(function () {
                        // route name: login.form
                        Route::get('/', ['uses' => 'form', 'as' => '.form']);
                        // route name: login
                        Route::post('/', ['uses' => 'login']);
                        Route::get('/{id}', ['uses' => 'login_by_id', 'as' => '.id']);
                    });
            });

        Route::name('password.')
            ->group(function () {
                Route::prefix('forgot-password')
                    ->controller(ForgotPasswordController::class)
                    ->group(function () {
                        Route::get('/', ['uses' => 'forgot_password_form', 'as' => 'request']);
                        Route::post('/', ['uses' => 'forgot_password', 'as' => 'email']);
                    });

                Route::prefix('reset-password')
                    ->controller(ResetPasswordController::class)
                    ->group(function () {
                        Route::get('{token}', ['uses' => 'reset_password_form', 'as' => 'reset']);
                        Route::post('/', ['uses' => 'reset_password', 'as' => 'update']);
                    });
            });
    });

Route::middleware(['auth'])
    ->group(function () {
        Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

        Route::withoutMiddleware(['verified'])
            ->group(function () {
                Route::get('email-verification-required', function () {
                    return view('manual_auth.email-verification', [
                        'title' => 'Email Verification Required',
                    ]);
                })->name('verification.notice');

                Route::post('logout', [LoginController::class, 'logout'])
                    ->name('logout');
            });

        // should only be accessed by admin
        Route::prefix('students')
            ->name('students.')
            ->middleware('auth.role:admin')
            ->controller(StudentController::class)
            ->group(function () {
                Route::get('/', ['uses' => 'index', 'as' => 'index']);
                Route::post('/', ['uses' => 'store', 'as' => 'store']);
                Route::get('create', ['uses' => 'create', 'as' => 'create']);

                Route::prefix('{student}')
                    ->group(function () {
                        Route::get('/', ['uses' => 'show', 'as' => 'show']);
                        Route::put('/', ['uses' => 'update', 'as' => 'update']);
                        Route::get('/edit', ['uses' => 'edit', 'as' => 'edit']);
                        Route::delete('/delete', ['uses' => 'destroy', 'as' => 'destroy']);
                    });
            });

        // should only be accessed by admin and registrar
        Route::get('student-registration', function () {
            return 'student registration';
        })->middleware('auth.role:registrar,admin');

        // should only be accessed by admin and cashier
        Route::get('student-payments', function () {
            return 'student payments';
        })->middleware('auth.role:cashier,admin');
    });

Route::prefix('temp')
    ->group(function () {
        Route::get('/temp', function () {
            /* session()->flash('greetings', 'Welcome to intern session.');

            return redirect('/temp2'); */

            session(['greetings' => 'hello world', 'message' => 'welcome to intern session']);

            return session()->all();
        });

        Route::get('/temp2', function () {
            return session()->all();
        });

        Route::get('/temp3', function () {
            session()->flush();

            return redirect('/temp/temp2');
        });
    });
