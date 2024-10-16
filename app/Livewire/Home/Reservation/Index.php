<?php

namespace App\Livewire\Home\Reservation;

use App\Models\Carts;
use App\Models\Meja;
use App\Models\ReservationItems;
use App\Models\Reservations;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Illuminate\Support\Str;

class Index extends Component
{
    public $floor = 1;
    public $numberpeople = 0;
    public $peoples, $tables;
    public $limitPeople = 20;
    public $tableVip, $limitVipTable;
    public $selectedTable, $date, $time, $preOrder;
    public $reservedTables = [];
    public $existingReservation = null;
    public $paymentOption = 100;

    public function rules()
    {
        return $rules = [
            'date' => 'required|date',
            'time' => 'required',
            'selectedTable' => 'required|integer',
            'numberpeople' => 'required|integer|min:1|max:' . $this->limitPeople,
            'preOrder' => 'nullable|boolean',
            'paymentOption' => 'required|integer',
        ];
    }


    public function messages()
    {
        return $messages = [
            'date.required' => 'The reservation date is required.',
            'date.date' => 'The reservation date must be a valid date.',
            'date.after_or_equal' => 'The reservation date must be today or later.',
            'date.before_or_equal' => 'The reservation date cannot be more than one month from today.',

            'time.required' => 'The reservation time is required.',
            'time.date_format' => 'The reservation time must be in a valid format (HH:MM).',
            'time.after_or_equal' => 'The reservation time cannot be earlier than 9:00 AM.',
            'time.before_or_equal' => 'The reservation time cannot be later than 9:00 PM.',

            'selectedTable.required' => 'Please select a table for your reservation.',
            'numberpeople.required' => 'Please specify the number of people.',
            'numberpeople.integer' => 'The number of people must be a valid number.',
            'numberpeople.max' => 'The number of people cannot exceed the table’s maximum capacity.',

            'paymentOption.required' => 'Please select a payment option.',
        ];
    }


    public function mount()
    {
        $this->peoples = 0;
        $this->numberpeople = $this->peoples;

        $this->loadExistingReservation();
        $this->loadTables();

        if ($this->existingReservation && $this->existingReservation->user_id !== Auth::id()) {
            $this->dispatch('notify', message: 'You are not authorized to modify this reservation.', type: 'error');
            return;
        }
    }

    public function updated($propertyName)
    {
        try {
            $this->validateOnly($propertyName);
            $this->loadReservedTables();
        } catch (\Illuminate\Validation\ValidationException $e) {
            $this->dispatch('notify', message: $e->getMessage(), type: 'error');
        }

        if (in_array($propertyName, ['date', 'time'])) {
            $this->loadTables();
        }
    }

    public function setFloor($floor)
    {
        $this->floor = $floor;
        $this->loadTables();
    }

    public function loadExistingReservation()
    {
        $this->existingReservation = Reservations::where('user_id', Auth::id())
            ->where('status', 'pending')
            ->first();

        if ($this->existingReservation) {
            $this->date = $this->existingReservation->reservation_date;
            $this->time = $this->existingReservation->reservation_time;
            $this->selectedTable = $this->existingReservation->table_id;
            $this->numberpeople = $this->existingReservation->guest_count;
            $this->preOrder = $this->existingReservation->is_preorder;
            $this->paymentOption = $this->existingReservation->payment_option;
            $this->peoples = $this->numberpeople;
        }
    }

    public function loadTables()
    {
        $capacity = $this->numberpeople % 2 == 1 ? $this->numberpeople + 1 : $this->numberpeople;

        $this->tables = Meja::where('floor', $this->floor)
            ->where('status', '!=', 0)
            ->where('capacity', '=', $capacity)
            ->orderBy('table_number')
            ->get();

        if ($this->numberpeople > 10) {
            $this->tableVip = Meja::where('capacity', '>=', $this->numberpeople)
                ->where('status', '!=', 0)
                ->orderBy('table_number')
                ->get();
        }

        $this->loadReservedTables();
    }

    public function loadReservedTables()
    {
        if ($this->date && $this->time) {
            $reservationTime = Carbon::parse($this->time);
            $minTime = $reservationTime->copy()->subMinutes(75);
            $maxTime = $reservationTime->copy()->addMinutes(75);

            $this->reservedTables = Reservations::where('reservation_date', $this->date)
                ->whereIn('status', ['pending', 'waiting', 'paid', 'confirmed'])
                ->whereBetween('reservation_time', [$minTime->format('H:i'), $maxTime->format('H:i')])
                ->pluck('table_id')
                ->toArray();
        }
    }

    public function addPeople()
    {
        $this->numberpeople = $this->peoples;
        $this->loadTables();
    }

    public function updatedPeoples()
    {
        if ($this->peoples > $this->limitPeople) {
            $this->peoples = $this->limitPeople;
        }
    }

    public function submit()
    {
        try {
            $this->validate();
        } catch (\Illuminate\Validation\ValidationException $e) {
            $this->dispatch('notify', message: implode(', ', $e->validator->errors()->all()), type: 'error');
            return;
        }

        try {
            $cart = Carts::where('user_id', Auth::id())->where('status', 'pending')->first();

            if (!$cart) {
                $this->dispatch('notify', message: 'Cart not found', type: 'error');
                return;
            }

            $tax = 0.11;
            $totalAmount = $cart->total_amount;

            $totalAmountWithTax = $totalAmount + ($totalAmount * $tax);

            $paymentAmount = $this->paymentOption == 50 ? $totalAmountWithTax / 2 : $totalAmountWithTax;

            if ($cart->used_points) {
                $pointsToUse = $cart->used_points;
                $paymentAmount -= $pointsToUse;
            }

            if ($this->existingReservation) {
                $this->existingReservation->update([
                    'table_id' => $this->selectedTable,
                    'reservation_date' => $this->date,
                    'reservation_time' => $this->time,
                    'guest_count' => $this->numberpeople,
                    'is_preorder' => $this->preOrder ? 1 : 0,
                    'payment_option' => $this->preOrder ? 100 : $this->paymentOption,
                    'total_amount' => $paymentAmount,
                    'updated_at' => now(),
                ]);
            } else {
                $reservation = Reservations::insertGetId([
                    'reservation_code' => Str::uuid(),
                    'user_id' => Auth::id(),
                    'table_id' => $this->selectedTable,
                    'reservation_date' => $this->date,
                    'reservation_time' => $this->time,
                    'guest_count' => $this->numberpeople,
                    'total_amount' => $paymentAmount,
                    'used_points' => $cart->used_points,
                    'discount_id' => $cart->discount_id ? $cart->discount_id : null,
                    'is_preorder' => $this->preOrder ? 1 : 0,
                    'payment_option' => $this->preOrder ? 100 : $this->paymentOption,
                    'status' => 'pending',
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);

                foreach ($cart->cartItems as $cartItem) {
                    ReservationItems::create([
                        'reservation_id' => $reservation,
                        'menu_id' => $cartItem->menu_id,
                        'quantity' => $cartItem->quantity,
                        'price' => $cartItem->menu->price * $cartItem->quantity,
                        'created_at' => now(),
                    ]);
                }
            }

            $this->redirect(route('payment'), navigate: true);
        } catch (\Throwable $th) {
            $this->dispatch('notify', message: 'Opss something went wrong ' . $th->getMessage(), type: 'error');
        }
    }

    public function render()
    {
        $floors = Meja::select('floor')->distinct()->get();
        $cart = Carts::where('user_id', Auth::id())->where('status', 'pending')->first();
        if (!$cart) {
            return redirect(route('home'));
        }

        $cartItems = $cart->cartItems;
        if ($cartItems->count() == 0) {
            return redirect(route('home'));
        }

        return view('livewire.home.reservation.index', [
            'floors' => $floors,
            'tables' => $this->tables,
            'cartItems' => $cartItems,
        ]);
    }
}
