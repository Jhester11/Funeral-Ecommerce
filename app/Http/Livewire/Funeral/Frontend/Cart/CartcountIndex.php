<?php

namespace App\Http\Livewire\Funeral\Frontend\Cart;

use App\Models\Cart;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class CartcountIndex extends Component
{
    public $cartCount;
    protected $listeners = ['CartAddedUpdated' => 'checkCartCount'];

    public function checkCartCount()
    {
        if (Auth::check()) {
            return $this->cartCount = Cart::where('user_id', auth()->user()->id)->count();
        } else {
            return $this->cartCount = 0;
        }
    }
    
    public function render()
    {
        $this->cartCount = $this->checkCartCount();
        return view('livewire.funeral.frontend.cart.cartcount-index', [
            'cartCount' => $this->cartCount
        ]);
    }
}
