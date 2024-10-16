<?php

use App\Http\Controllers\ArticlesController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MejaController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\ReservationsController;
use Illuminate\Routing\RouteGroup;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::permanentRedirect('/', '/home');

Route::controller(HomeController::class)->group(function () {
    Route::get('/home', 'index')->name('home');
    Route::get('/menu', 'menu')->name('menu');
    Route::get('/about', 'about')->name('about');
    Route::get('/articles', 'articles')->name('articles');
    Route::get('/articles/{slug}', 'articlesDetail')->name('articles.detail');
    Route::get('/contact', 'contact')->name('contact');

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

Route::group(['middleware' => ['auth', 'admin']], function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/dashboard/profile', [DashboardController::class, 'profile'])->name('dashboard.profile');
    Route::get('/dashboard/menu-list', [MenuController::class, 'adminIndex'])->name('dashboard.menu');
    Route::get('/dashboard/reservations', [ReservationsController::class, 'index'])->name('dashboard.reservations');
    Route::get('/dashboard/users', [DashboardController::class, 'users'])->name('dashboard.users');
    Route::get('/dashboard/tables', [MejaController::class, 'index'])->name('dashboard.tables');
    Route::get('/dashboard/reports', [DashboardController::class, 'reports'])->name('dashboard.reports');
    Route::get('/dashboard/articles', [ArticlesController::class, 'index'])->name('dashboard.articles');
    Route::get('/dashboard/articles/create', [ArticlesController::class, 'create'])->name('dashboard.article.create');
    Route::get('/dashboard/articles/edit/{slug}', [ArticlesController::class, 'edit'])->name('dashboard.article.edit');
});

// khusus koki
Route::group(['middleware' => ['auth', 'koki']], function () {
    Route::get('/dashboard/kitchen', [DashboardController::class, 'kitchen'])->name('kitchen');
    Route::get('/dashboard/reservation/{code}/detail', [ReservationsController::class, 'detail'])->name('kitchen.reservation.detail');
});

// khusus kasir
Route::group(['middleware' => ['auth', 'kasir']], function () {
    Route::get('/dashboard/kasir', [DashboardController::class, 'kasir'])->name('kasir');
});

Route::post('/logout', function () {
    Auth::logout();
    return redirect('/home');
})->name('logout');



require __DIR__.'/auth.php';
