<?php

namespace App\Http\Livewire\Funeral\Frontend\Product;

use App\Models\Cart;
use Livewire\Component;
use App\Models\Wishlist;
use Illuminate\Support\Facades\Auth;

class ViewIndex extends Component
{
    public $category, $products, $prodColorSelectedQuantity, $quantityCount = 1, $productColorId;

    public function addToWishList($productId)
    {
        if (Auth::check()) {
            if (Wishlist::where('user_id', auth()->user()->id)->where('product_id', $productId)->exists()) {
                $this->dispatchBrowserEvent('swal:warning', [
                    'type' => 'success',
                    'title' => 'Already added to wishlist!',
                    'text' => '',
                ]);
                // session()->flash('message', 'Already added to wishlist');
                return false;
            } else {
                Wishlist::create([
                    'user_id' => auth()->user()->id,
                    'product_id' => $productId
                ]);
                $this->emit('wishlistAddedUpdated');
                $this->dispatchBrowserEvent('swal:store', [
                    'type' => 'success',
                    'title' => 'Wishlist Added successfully.',
                    'text' => '',
                ]);
                // session()->flash('message', 'Wishlist Added successfully');
            }
        } else {
            $this->dispatchBrowserEvent('swal:info', [
                'type' => 'success',
                'title' => 'Please Login to continue!',
                'text' => '',
            ]);
            // session()->flash('message', 'Please Login to continue.');
            return false;
        }
    }

    public function colorSelected($productColorId)
    {
        // dd($productColorId);
        $this->productColorId = $productColorId;
        $productColors = $this->products->productColors()->where('id', $productColorId)->first();
        $this->prodColorSelectedQuantity = $productColors->quantity;

        if ($this->prodColorSelectedQuantity == 0) {
            $this->prodColorSelectedQuantity = 'outOfStock';
        }
    }


    public function increementQuantity()
    {
        if ($this->quantityCount < 10) {
            $this->quantityCount++;
        }
    }
    public function decrementQuantity()
    {
        if ($this->quantityCount > 1) {
            $this->quantityCount--;
        }
    }

    public function mount($category, $products)
    {
        $this->category = $category;
        $this->products  = $products;
    }

    public function addToCart(int $productId)
    {
        if (Auth::check()) {
            // dd($productId);
            if ($this->products->where('id', $productId)->where('status', '0')->exists()) {
                // Checking for product color quantity and add to cart
                if ($this->products->productColors()->count() > 1) {
                    if ($this->prodColorSelectedQuantity != NULL) {
                        if (Cart::where('user_id', auth()->user()->id)
                            ->where('product_id', $productId)
                            ->where('product_color_id', $this->productColorId)
                            ->exists()
                        ) {
                            $this->dispatchBrowserEvent('swal:exists', [
                                'type' => 'success',
                                'title' => 'Product Already Added!',
                                'text' => '',
                            ]);
                        } else {
                            $productColor = $this->products->productColors()->where('id', $this->productColorId)->first();
                            if ($productColor->quantity > 0) {
                                if ($productColor->quantity > $this->quantityCount) {
                                    // Inserting Products to cart
                                    Cart::create([
                                        'user_id' => auth()->user()->id,
                                        'product_id' => $productId,
                                        'product_color_id' => $this->productColorId,
                                        'quantity' => $this->quantityCount,
                                    ]);
                                    $this->emit('CartAddedUpdated');
                                    $this->dispatchBrowserEvent('swal:addedSuccessfully', [
                                        'type' => 'success',
                                        'title' => 'Product Added to Cart!',
                                        'text' => '',
                                    ]);
                                } else {
                                    $this->dispatchBrowserEvent('message', [
                                        'text' => 'Only ' . $productColor->quantity . ' Quantity Available!',
                                        'type' => 'warning',
                                        'status' => 404
                                    ]);
                                }
                            } else {
                                $this->dispatchBrowserEvent('message', [
                                    'text' => 'Out of Stock!',
                                    'type' => 'warning',
                                    'status' => 404
                                ]);
                            }
                        }
                    } else {
                        $this->dispatchBrowserEvent('message', [
                            'text' => 'Select Your Product Color!',
                            'type' => 'info',
                            'status' => 404
                        ]);
                    }
                } else {
                    if (Cart::where('user_id', auth()->user()->id)->where('product_id', $productId)->exists()) {
                        $this->dispatchBrowserEvent('swal:exists', [
                            'type' => 'success',
                            'title' => 'Product Already Added!',
                            'text' => '',
                        ]);
                    } else {
                        if ($this->products->quantity > 0) {
                            if ($this->products->quantity > $this->quantityCount) {
                                // Inserting Products to cart
                                Cart::create([
                                    'user_id' => auth()->user()->id,
                                    'product_id' => $productId,
                                    'quantity' => $this->quantityCount,
                                ]);
                                $this->emit('CartAddedUpdated');
                                $this->dispatchBrowserEvent('swal:addedSuccessfully', [
                                    'type' => 'success',
                                    'title' => 'Product Added to Cart!',
                                    'text' => '',
                                ]);
                            } else {
                                $this->dispatchBrowserEvent('message', [
                                    'text' => 'Only' . $this->products->quantity . 'Quantity Available!',
                                    'type' => 'warning',
                                    'status' => 404
                                ]);
                            }
                        } else {
                            $this->dispatchBrowserEvent('message', [
                                'text' => 'Out of Stock!',
                                'type' => 'warning',
                                'status' => 404
                            ]);
                        }
                    }
                }
            } else {
                $this->dispatchBrowserEvent('message', [
                    'text' => 'Product does not exists!',
                    'type' => 'warning',
                    'status' => 404
                ]);
            }
        } else {
            $this->dispatchBrowserEvent('swal:addtocart', [
                'type' => 'info',
                'title' => 'Please Login to add to cart!',
                'text' => '',
            ]);
        }
    }

    public function render()
    {
        return view('livewire.funeral.frontend.product.view-index', [
            'category' => $this->category,
            'products' => $this->products,
        ]);
    }
}
