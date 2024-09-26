<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MenuController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::permanentRedirect('/', '/home');

Route::controller(HomeController::class)->group(function () {
    Route::get('/home', 'index')->name('home');
    Route::get('/menu', 'menu')->name('menu');
    Route::get('/about', 'about')->name('about');

    // auth
    Route::middleware('auth')->group(function () {
        Route::get('/cart', 'cart')->name('cart');
        Route::get('/reservation', 'reservation')->name('reservation');
        Route::get('/payment', 'payment')->name('payment');
        Route::get('/user/dashboard', 'dashboard')->name('home.dashboard');
        Route::get('/user/dashboard/profile', 'dashboardProfile')->name('home.profile');
        Route::get('/user/dashboard/reservations', 'dashboardReservations')->name('home.reservations');
        Route::get('/user/dashboard/reservations/detail/{id}', 'dashboardReservationDetail')->name('reservation.detail');
    });
});

// Route::view('dashboard', 'dashboard')
//     ->middleware(['auth', 'verified'])
//     ->name('dashboard');

Route::group(['middleware' => ['auth', 'admin']], function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/dashboard/profile', [DashboardController::class, 'profile'])->name('dashboard.profile');
    Route::get('/dashboard/menu-list', [MenuController::class, 'adminIndex'])->name('dashboard.menu');
});

Route::post('/logout', function () {
    Auth::logout();
    return redirect('/home');
})->name('logout');



require __DIR__.'/auth.php';
