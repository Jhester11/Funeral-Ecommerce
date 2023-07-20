<?php

namespace App\Http\Livewire\Funeral\Frontend\Product;

use Livewire\Component;
use App\Models\Wishlist;

class WishlistshowIndex extends Component
{
    public function removeWishlistItem(int $wishlistId)
    {
        // dd($wishlistId);
        Wishlist::where('user_id', auth()->user()->id)->where('id', $wishlistId)->delete();
        $this->emit('wishlistAddedUpdated');
        $this->dispatchBrowserEvent( 'swal:delete', [
            'type' => 'success',
            'title' => 'Already added to Wishlist Item Removed Successfully!',
            'text' => '',
        ]);
    }
    
    public function render()
    {
        $wishlist = Wishlist::where('user_id', auth()->user()->id)->get();
        return view('livewire.funeral.frontend.product.wishlistshow-index', [
            'wishlist' => $wishlist
        ]);
    }
}
