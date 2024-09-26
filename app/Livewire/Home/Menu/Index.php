<?php

namespace App\Livewire\Home\Menu;

use App\Models\CartItems;
use App\Models\Carts;
use App\Models\Menu;
use App\Models\MenuCategory;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Index extends Component
{
    public $menus = [];
    public $menuCategory = [];
    public $selectedCategory = null;
    public $isHalal = null;

    public function mount()
    {
        $this->menus = Menu::all();
        $this->menuCategory = MenuCategory::all();
    }

    public function filterByCategory($categoryId)
    {
        if ($this->selectedCategory === $categoryId) {
            $this->selectedCategory = null; // Reset if the same category is clicked
        } else {
            $this->selectedCategory = $categoryId;
        }

        $this->applyFilters();
    }

    public function toggleHalalFilter()
    {
        if ($this->isHalal) {
            $this->isHalal = null;
        } else {
            $this->isHalal = true;
        }

        $this->applyFilters();
    }

    public function applyFilters()
    {
        $query = Menu::query();

        if ($this->selectedCategory) {
            $query->where('category_id', $this->selectedCategory);
        }

        if ($this->isHalal) {
            $query->where('is_halal', true);
        }

        $this->menus = $query->get();
    }

    public function render()
    {
        return view('livewire.home.menu.index', [
            'menuCategory' => $this->menuCategory,
        ]);
    }

    public function addToCart($id)
    {
        if (!Auth::check()) {
            $this->dispatch('notify', message: 'You must be logged in to add to cart', type: 'warning');
            return;
        }

        try {
            $menu = Menu::findOrFail($id);

            if (!$menu) {
                $this->dispatch('notify', message: 'Menu not found', type: 'warning');
                return;
            }

            $cart = Carts::firstOrCreate(
                ['user_id' => Auth::user()->id, 'status' => 'pending'],
                ['created_at' => now(), 'updated_at' => now()]
            );

            $cartItem = CartItems::where('cart_id', $cart->id)->where('menu_id', $menu->id)->first();

            if ($cartItem) {
                $newQuantity = $cartItem->quantity + 1;
                $cartItem->update([
                    'quantity' => $newQuantity,
                    'price' => $menu->price * $newQuantity,
                ]);
            } else {
                CartItems::create([
                    'cart_id' => $cart->id,
                    'menu_id' => $menu->id,
                    'quantity' => 1,
                    'price' => $menu->price,
                    'created_at' => now(),
                ]);
            }

            $totalAmount = CartItems::where('cart_id', $cart->id)->sum('price');

            $cart->update([
                'total_amount' => $totalAmount,
                'updated_at' => now(),
            ]);

            $this->dispatch('notify', message: 'Successfully added to cart', type: 'success');
            $this->dispatch('cartAdded');
        } catch (\Throwable $th) {
            $this->dispatch('notify', message: 'Opss something went wrong', type: 'error');
            return;
        }
    }
}
