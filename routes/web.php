<?php

use App\Http\Controllers\ManualAuth\LoginController;
use App\Http\Controllers\StudentController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::redirect('/', 'home');

// Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

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

        Route::post('logout', ['uses' => 'logout', 'as' => 'logout']);
    });

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

    return redirect('/temp2');
});

Route::prefix('students')
    ->name('students.')
    ->controller(StudentController::class)
    ->middleware(['auth'])
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
