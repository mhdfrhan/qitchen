<?php

namespace App\Livewire\Home\Payment;

use App\Models\Carts;
use App\Models\Reservations;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\On;
use Livewire\Component;
use Midtrans\Config;
use Midtrans\Snap;

class Index extends Component
{
    public $carts, $cartItems = [], $reservation, $snapToken, $pointsToAdd = 0;

    public function mount()
    {
        $this->initializeCartAndReservationData();
        $this->processPayment();
    }

    protected function initializeCartAndReservationData()
    {
        if ($this->reservation) {
            $this->carts = Carts::where('user_id', Auth::user()->id)
                ->where('status', 'pending')
                ->first();

            if ($this->carts) {
                $this->cartItems = $this->carts->cartItems;
            } else {
                $this->dispatch('notify', message: 'No pending carts found', type: 'error');
            }
        } else {
            $this->dispatch('notify', message: 'Reservation not found', type: 'error');
        }
    }

    protected function processPayment()
    {
        try {
            $this->configureMidtrans();

            $items = $this->getItemsDetails();

            $params = $this->generateTransactionParams($items);

            $this->snapToken = Snap::getSnapToken($params);

            $this->updateReservationWithSnapToken();

            $this->updateLoyaltyPoints();
        } catch (\Exception $e) {
            $this->dispatch('notify', message: 'Payment failed: ' . $e->getMessage(), type: 'error');
        }
    }

    protected function configureMidtrans()
    {
        try {
            Config::$serverKey = config('midtrans.serverKey');
            Config::$isProduction = config('midtrans.isProduction', false);
            Config::$isSanitized = true;
            Config::$is3ds = true;
        } catch (\Throwable $th) {
            $this->dispatch('notify', message: $th->getMessage(), type: 'error');
            return;
        }
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

    protected function generateTransactionParams($items)
    {
        $grossAmount = $this->reservation->total_amount;
        try {
            return [
                'transaction_details' => [
                    'order_id' => uniqid(), // Pastikan order_id unik
                    'gross_amount' => $grossAmount,
                ],
                'customer_details' => [
                    'first_name' => Auth::user()->name,
                    'email' => Auth::user()->email,
                    'phone' => Auth::user()->phone ?? Auth::user()->phone,
                ],
                'item_details' => $items,
            ];
        } catch (\Throwable $th) {
            $this->dispatch('notify', message: $th->getMessage(), type: 'error');
            return;
        }
    }

    protected function updateReservationWithSnapToken()
    {
        if (!$this->snapToken) {
            $this->dispatch('notify', message: 'Failed to get Snap Token', type: 'error');
            return;
        }

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

        $this->reservation->status = 'waiting';
        $this->reservation->save();

        $user->loyalty_points += $this->pointsToAdd;
        $user->save();

        $this->carts->delete();

        $this->dispatch('notify', message: 'Yey! Payment success, your reservation has been confirmed', type: 'success');
    }

    public function navigate($route)
    {
        return $this->redirect(route($route, $this->reservation->reservation_code), navigate: true);
    }

    public function render()
    {
        return view('livewire.home.payment.index');
    }
}
