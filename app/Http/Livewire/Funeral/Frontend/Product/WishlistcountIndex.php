<?php

namespace App\Http\Livewire\Funeral\Frontend\Product;

use Livewire\Component;
use App\Models\Wishlist;
use Illuminate\Support\Facades\Auth;

class WishlistcountIndex extends Component
{
    public $wishlistCount;
    protected $listeners = ['wishlistAddedUpdated' => 'checkWishlistCount'];

    public function checkWishlistCount()
    {
        if(Auth::check()) {
            return $this->wishlistCount = Wishlist::where('user_id', auth()->user()->id)->count();
        }
        else {
            return $this->wishlistCount = 0;
        }
    }
    
    public function render()
    {
        $this->wishlistCount = $this->checkWishlistCount();
        return view('livewire.funeral.frontend.product.wishlistcount-index', [
            'wishlistCount' => $this->wishlistCount
        ]);
    }
}
