<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Articles;
use App\Models\Carts;
use App\Models\MenuCategory;
use App\Models\Reservations;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {
        return view('home.index', [
            'title' => 'Home'
        ]);
    }

    public function menu()
    {
        return view('home.menu', [
            'title' => 'Menu',
        ]);
    }

    public function about()
    {
        return view('home.about', [
            'title' => 'About'
        ]);
    }

    public function cart()
    {
        return view('home.cart', [
            'title' => 'Cart'
        ]);
    }

    public function reservation()
    {
        $cart = Carts::where('user_id', Auth::user()->id)->where('status', 'pending')->first();

        if (!$cart) {
            return redirect(route('menu'));
        }

        if ($cart->cartItems->count() == 0) {
            return redirect(route('cart'));
        }

        return view('home.reservation', [
            'title' => 'Reservation'
        ]);
    }

    public function payment()
    {
        $carts = Carts::where('user_id', Auth::user()->id)->where('status', 'pending')->first();

        if (!$carts) {
            return redirect(route('menu'));
        }

        if ($carts->cartItems->count() == 0) {
            return redirect(route('cart'));
        }

        $reservation = Reservations::where('user_id', Auth::user()->id)->where('status', 'pending')->first();

        if (!$reservation) {
            return redirect(route('cart'));
        }

        return view('home.payment', [
            'title' => 'Payment',
            'carts' => $carts,
            'reservation' => $reservation
        ]);
    }

    public function dashboard()
    {
        return view('home.dashboard.index', [
            'title' => 'Dashboard',
        ]);
    }

    public function dashboardProfile()
    {
        return view('home.dashboard.profile', [
            'title' => 'Profile',
        ]);
    }

    public function dashboardReservations()
    {
        return view('home.dashboard.reservations', [
            'title' => 'Reservations',
        ]);
    }

    public function dashboardReservationDetail($id)
    {
        $reservation = Reservations::where('reservation_code', $id)->first();
        if (!$reservation) {
            return redirect(route('home'));
        }

        return view('home.dashboard.reservation-detail', [
            'title' => 'Reservation Detail',
            'reservation' => $reservation,
        ]);
    }

    public function articles() {
        return view('home.articles', [
            'title' => 'Articles',
        ]);
    }

    public function articlesDetail($slug) {
        $article = Articles::where('slug', $slug)->first();
        if (!$article) {
            return redirect(route('home'));
        }
        return view('home.article-detail', [
            'title' => 'Article Detail',
            'article' => $article
        ]);
    }

    public function contact()
    {
        return view('home.contact', [
            'title' => 'Contact'
        ]);
    }
}
