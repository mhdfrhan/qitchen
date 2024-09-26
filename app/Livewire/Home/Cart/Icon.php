<?php

namespace App\Livewire\Home\Cart;

use App\Models\Carts;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\On;
use Livewire\Component;

class Icon extends Component
{
    public $totalCart = 0;

    #[On('cartAdded')]
    public function render()
    {
        if (!Auth::check()) {
            $this->totalCart = 0;
        } else {
            $cart = Carts::where('user_id', Auth::user()->id)->where('status', 'pending')->first();
            if ($cart) {
                $carItems = $cart->cartItems->count();
                $this->totalCart = $carItems;
            } else {
                $this->totalCart = 0;
            }
        }
        return view('livewire.home.cart.icon');
    }
}
