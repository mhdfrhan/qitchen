<?php

namespace App\Livewire\Home\Dashboard;

use App\Models\Carts;
use App\Models\Reservations;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\On;
use Livewire\Component;

class ReservationDetail extends Component
{
    public $carts, $cartItems, $reservation, $snapToken, $pointsToAdd;

    public function mount()
    {
        $this->initializeReservationData();
    }

    protected function initializeReservationData()
    {
        // Cek jika reservation tersedia dan statusnya pending
        if ($this->reservation && $this->reservation->status == 'pending') {
            $this->carts = Carts::where('user_id', Auth::user()->id)
                ->where('status', 'pending')
                ->first();

            if ($this->carts) {
                $this->cartItems = $this->carts->cartItems;
                $this->processPayment();
            }
        }
    }

    protected function processPayment()
    {
        try {
            // Konfigurasi Midtrans
            $this->configureMidtrans();

            // Buat detail item untuk pembayaran
            $items = $this->getItemsDetails();

            // Buat parameter transaksi
            $params = [
                'transaction_details' => [
                    'order_id' => uniqid(), // Pastikan order_id unik
                    'gross_amount' => $this->reservation->total_amount,
                ],
                'customer_details' => [
                    'first_name' => Auth::user()->name,
                    'email' => Auth::user()->email,
                    'phone' => Auth::user()->phone ?? Auth::user()->phone,
                ],
                'item_details' => $items,
            ];

            // Ambil Snap Token dari Midtrans
            $this->snapToken = \Midtrans\Snap::getSnapToken($params);

            // Simpan snap token dan perbarui poin loyalitas
            $this->updateReservationWithSnapToken();
            $this->updateLoyaltyPoints();
        } catch (\Exception $e) {
            $this->dispatch('notify', message: 'Payment failed: ' . $e->getMessage(), type: 'error');
        }
    }

    protected function configureMidtrans()
    {
        \Midtrans\Config::$serverKey = config('midtrans.serverKey');
        \Midtrans\Config::$isProduction = config('midtrans.isProduction', false);
        \Midtrans\Config::$isSanitized = true;
        \Midtrans\Config::$is3ds = true;
    }

    protected function getItemsDetails()
    {
        try {
            $items = [];
            $totalFullPrice = 0;

            foreach ($this->cartItems as $item) {
                $fullPrice = (int)$item->price + $item->price * 0.11;
                $totalFullPrice += $fullPrice * $item->quantity;

                $items[] = [
                    'id' => $item->menu_id,
                    'price' => $fullPrice,
                    'quantity' => $item->quantity,
                    'name' => $item->menu->name,
                ];
            }

            // Hitung faktor diskon
            $discountFactor = $this->reservation->total_amount / $totalFullPrice;

            // Sesuaikan harga setiap item
            foreach ($items as &$item) {
                $item['price'] = round($item['price'] * $discountFactor);
            }

            return $items;
        } catch (\Throwable $th) {
            $this->dispatch('notify', message: $th->getMessage(), type: 'error');
            return;
        }
    }

    protected function updateReservationWithSnapToken()
    {
        $this->reservation->snap_token = $this->snapToken;
        $this->reservation->save();
    }

    protected function updateLoyaltyPoints()
    {
        $user = Auth::user();

        if ($this->carts->used_points > 0) {
            $user->loyalty_points -= $this->carts->used_points;
        }

        $this->pointsToAdd = $this->calculateLoyaltyPoints($this->reservation->total_amount);
    }

    protected function calculateLoyaltyPoints($totalAmount)
    {
        if ($totalAmount > 500000) {
            return 35000;
        } elseif ($totalAmount > 300000) {
            return 25000;
        } elseif ($totalAmount > 200000) {
            return 15000;
        } elseif ($totalAmount > 100000) {
            return 10000;
        } elseif ($totalAmount > 50000) {
            return 5000;
        }

        return 0;
    }

    #[On('payment-success')]
    public function paymentSuccess()
    {
        $user = Auth::user();

        // Perbarui status reservasi
        $this->reservation->status = 'waiting';
        $this->reservation->save();

        $user->loyalty_points += $this->pointsToAdd;
        $user->save();

        // Hapus keranjang
        $this->carts->delete();
        session()->forget('numberpeople');

        $this->dispatch('notify', message: 'Yey! Payment success, your reservation has been confirmed', type: 'success');
    }

    public function cancelReservation()
    {
        if ($this->reservation->status == 'pending') {
            $this->reservation->status = 'cancelled';
            $this->reservation->save();

            $this->carts->delete();
            session()->forget('numberpeople');

            $this->dispatch('notify', message: 'Reservation has been cancelled', type: 'success');
        }
    }

    public function navigate($route)
    {
        return $this->redirect(route($route, $this->reservation->reservation_code), navigate: true);
    }

    public function render()
    {
        return view('livewire.home.dashboard.reservation-detail');
    }
}
