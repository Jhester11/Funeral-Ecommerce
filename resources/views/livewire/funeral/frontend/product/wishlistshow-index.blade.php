<div>

    <div>
        <div class="py-3 py-md-5 bg-light">
            <div class="container">
                <h2 style="font-weight:800; font-family:Poppins;">My Wishlist</h2>
                <hr>
                <div class="row " style="font-family:Poppins;">
                    <div class="col-md-12 ">
                        <div class="shopping-cart">

                            <div class="cart-header d-none d-sm-none d-mb-block d-lg-block">
                                <div class="row">
                                    <div class="col-md-6 ">
                                        <h4>Products</h4>
                                    </div>
                                    <div class="col-md-2">
                                        <h4>Price</h4>
                                    </div>
                                    <div class="col-md-4">
                                        <h4>Remove</h4>
                                    </div>
                                </div>
                            </div>

                            @forelse ($wishlist as $wishlistItem)
                                @if ($wishlistItem->products)
                                    <div class="cart-item">
                                        <div class="row" style="font-weight:300;">
                                            <div class="col-md-6 my-auto">
                                                <a
                                                    href="{{ url('collections/' . $wishlistItem->products->category->slug . '/' . $wishlistItem->products->slug) }}">
                                                    <label class="product-name">
                                                        <img src="{{ $wishlistItem->products->productImages[0]->image }}"
                                                            style="width: 50px; height: 50px"
                                                            alt="{{ $wishlistItem->products->name }}" />
                                                        {{ $wishlistItem->products->name }}
                                                    </label>
                                                </a>
                                            </div>
                                            <div class="col-md-2 my-auto">
                                                <label
                                                    class="price"><span>₱</span>{{ $wishlistItem->products->selling_price }}.00
                                                </label>
                                            </div>

                                            <div class="col-md-4 col-12 my-auto">
                                                <div class="remove">
                                                    <button type="button"
                                                        wire:click="removeWishlistItem({{ $wishlistItem->id }})"
                                                        class="btn btn-outline-danger btn-sm">
                                                        <span wire:loading.remove
                                                            wire:target="removeWishlistItem({{ $wishlistItem->id }})">
                                                            <i class="fa fa-trash"></i> Remove
                                                        </span>
                                                        <span wire:loading
                                                            wire:target="removeWishlistItem({{ $wishlistItem->id }})">
                                                            <i class="fa fa-trash"></i>
                                                            Removing...
                                                        </span>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            @empty
                                <h4 class="text-center">No Wishlist Added</h4>
                            @endforelse

                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

</div>
{{-- Script for sweet alert notification delete --}}
<script type="text/javascript">
    // Delete
    window.addEventListener('swal:delete', event => {
        Swal.fire(
            'Success!',
            ' Wishlist Item Removed Successfully!',
            'success'
        )
    });
</script>
