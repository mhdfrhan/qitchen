<?php

namespace App\Livewire\Home\Cart;

use App\Models\CartItems;
use App\Models\Carts;
use App\Models\Discounts;
use App\Models\Reservations;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Index extends Component
{
    public $cartItems, $coupon, $totalDiscount, $usePoints;

    public function mount()
    {
        $carts = Carts::where('user_id', Auth::user()->id)->where('status', 'pending')->first();

        if ($carts && $carts->used_points > 0) {
            $this->usePoints = true;
        }
    }
    public function render()
    {
        $carts = Carts::where('user_id', Auth::user()->id)->where('status', 'pending')->first();

        if ($carts) {
            $this->cartItems = $carts->cartItems;
            if ($carts->discounts && $carts->discount_id != null) {
                $this->coupon = $carts->discounts->code;
                $this->totalDiscount = $carts->discounts->discount_amount;
            }
        } else {
            $this->cartItems = collect();
        }


        return view('livewire.home.cart.index', [
            'cartItems' => $this->cartItems,
            'carts' => $carts
        ]);
    }

    public function applyCoupon()
    {
        $cart = Carts::where('user_id', Auth::user()->id)->where('status', 'pending')->first();
        $coupon = Discounts::where('code', $this->coupon)->first();

        if ($cart && $coupon && !$cart->discount_amount) {
            $discountedAmount = $cart->total_amount - ($cart->total_amount * $coupon->discount_amount / 100);
            $cart->update([
                'total_amount' => max($discountedAmount, 0),
                'discount_id' => $coupon->id,
                'updated_at' => now(),
            ]);
            $this->totalDiscount = $coupon->discount_amount;

            $this->dispatch('notify', message: 'Coupon Successfully used', type: 'success');
        } elseif ($cart && $cart->discount_amount) {
            $this->dispatch('notify', message: 'Coupons already applied', type: 'warning');
        } else {
            $this->dispatch('notify', message: 'Invalid coupon or cart not found', type: 'error');
        }
    }

    public function updatedUsePoints()
    {
        $cart = Carts::where('user_id', Auth::user()->id)->where('status', 'pending')->first();

        if ($cart && $this->usePoints) {
            $pointsToUse = min(Auth::user()->loyalty_points, $cart->total_amount);
            // $cart->total_amount -= $pointsToUse; 
            $cart->used_points += $pointsToUse;
            $cart->save();

            $this->totalDiscount = $pointsToUse;
        } else {
            // $cart->total_amount += Auth::user()->loyalty_points;
            $cart->used_points -= Auth::user()->loyalty_points;
            $cart->save();
        }
    }

    public function decrement($id)
    {
        $cartItems = CartItems::where('id', $id)->first();
        $cartId = $cartItems->cart_id;

        if ($cartItems->quantity > 1) {
            $cartItems->decrement('quantity');
            $cartItems->price = $cartItems->menu->price * $cartItems->quantity;
            $cartItems->save();
        } else {
            $cartItems->delete();
            $this->dispatch('notify', message: 'Menu removed from cart', type: 'success');
            $this->dispatch('cartAdded');
        }

        $this->updateCartTotalAmount($cartId);

        // Hapus cart jika tidak ada item lagi
        $remainingItems = CartItems::where('cart_id', $cartId)->count();
        if ($remainingItems == 0) {
            Carts::where('id', $cartId)->delete();
        }
    }

    public function increment($id)
    {
        $cartItems = CartItems::where('id', $id)->first();
        $cartItems->increment('quantity');
        $cartItems->price = $cartItems->menu->price * $cartItems->quantity;
        $cartItems->save();

        $this->updateCartTotalAmount($cartItems->cart_id);
    }

    private function updateCartTotalAmount($cartId)
    {
        $cart = Carts::find($cartId);
        $totalAmount = CartItems::where('cart_id', $cart->id)->sum('price');

        $cart->update([
            'total_amount' => $totalAmount,
            'updated_at' => now(),
        ]);
    }
}
