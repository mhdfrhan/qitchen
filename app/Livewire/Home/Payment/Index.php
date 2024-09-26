<?php

namespace App\Livewire\Home\Payment;

use App\Models\Carts;
use App\Models\ReservationItems;
use App\Models\Reservations;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\On;
use Livewire\Component;
use Midtrans\Config;
use Midtrans\Snap;

class Index extends Component
{
    public $carts, $cartItems, $reservation, $snapToken, $pointsToAdd = 0;


    #[On('payment-success')]
    public function paymentSuccess()
    {
        // Update status reservation
        $this->reservation->status = 'waiting';
        $this->reservation->save();

        // Update loyalty points
        $user = Auth::user();

        if ($this->carts->used_points > 0) {
            $user->loyalty_points -= $this->carts->used_points;
            $user->save();
        }

        $user->loyalty_points += $this->pointsToAdd;
        $user->save();

        $this->dispatch('notify', message: 'Yey! Payment success, your reservation has been confirmed', type: 'success');

        $this->carts->delete();
        session()->forget('numberpeople');
    }

    public function mount()
    {
        $this->cartItems = $this->carts->cartItems;
        $this->processPayment();
    }

    public function processPayment()
    {
        // Set your Merchant Server Key
        \Midtrans\Config::$serverKey = config('midtrans.serverKey');
        // Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
        \Midtrans\Config::$isProduction = false;
        // Set sanitization on (default)
        \Midtrans\Config::$isSanitized = true;
        // Set 3DS transaction for credit card to true
        \Midtrans\Config::$is3ds = true;

        // Ambil data item dari cart
        $items = [];
        foreach ($this->cartItems as $item) {
            $items[] = [
                'id' => $item->menu_id,
                'price' => $item->price,
                'quantity' => $item->quantity,
                'name' => $item->menu->name,
            ];
        }

        // Tambahkan detail reservasi sebagai item tambahan
        $items[] = [
            'id' => 'reservation',
            'price' => 0, // Jika tidak dikenakan biaya khusus untuk reservasi
            'quantity' => 1,
            'name' => 'Reservation on ' . $this->reservation->reservation_date . ' at ' . $this->reservation->reservation_time .
                ', Table ' . $this->reservation->table_id . ', for ' . $this->reservation->guest_count . ' guests',
        ];

        $params = array(
            'transaction_details' => array(
                'order_id' => rand(),
                'gross_amount' => $this->reservation->total_amount,
            ),
            'customer_details' => array(
                'first_name' => Auth::user()->name,
                'email' => Auth::user()->email,
                'phone' => Auth::user()->phone ?? Auth::user()->phone,
            ),
            'item_details' => $items, // Menambahkan item details ke dalam request
        );

        $snapToken = \Midtrans\Snap::getSnapToken($params);

        if (!$snapToken) {
            $this->dispatch('notify', message: 'Payment failed', type: 'error');
            return;
        }

        $this->snapToken = $snapToken;

        // Update loyalty points
        $user = Auth::user();
        $totalAmount = $this->reservation->total_amount;

        if ($totalAmount > 500000) {
            $this->pointsToAdd = 35000;
        } elseif ($totalAmount > 300000) {
            $this->pointsToAdd = 25000;
        } elseif ($totalAmount > 200000) {
            $this->pointsToAdd = 15000;
        } elseif ($totalAmount > 100000) {
            $this->pointsToAdd = 10000;
        } elseif ($totalAmount > 50000) {
            $this->pointsToAdd = 5000;
        }

        $this->reservation->snap_token = $snapToken;
        $this->reservation->save();
    }


    public function render()
    {
        return view('livewire.home.payment.index');
    }

    public function navigate($route)
    {
        return $this->redirect(route($route));
    }
}
