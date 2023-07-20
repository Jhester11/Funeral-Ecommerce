<div>
    {{-- Products --}}
    <div class="py-3 py-md-5">
        <div class="container">
            {{-- Alert --}}
            @if (session()->has('message'))
                <div class="alert alert-success">
                    {{ session('message') }}
                </div>
            @endif
            <div class="row">
                <div class="col-md-5 mt-3">
                    <div class="bg-white border" wire:ignore>
                        @if ($products->productImages)
                            {{-- <img src="{{ asset($products->productImages[0]->image) }}"  class="w-100"
                                alt="Img"> --}}
                            <div class="exzoom" id="exzoom">

                                <div class="exzoom_img_box">
                                    <ul class='exzoom_img_ul'>
                                        @foreach ($products->productImages as $itemImage)
                                            <li><img src="{{ asset($itemImage->image) }}" /></li>
                                        @endforeach
                                    </ul>
                                </div>
                                <div class="exzoom_nav"></div>
                                <p class="exzoom_btn">
                                    <a href="javascript:void(0);" class="exzoom_prev_btn">
                                        < </a>
                                            <a href="javascript:void(0);" class="exzoom_next_btn"> > </a>
                                </p>
                            </div>
                        @else
                            No Image Added
                        @endif
                    </div>
                </div>
                <div class="col-md-7 mt-3">
                    <div class="product-view">
                        <h4 class="product-name" style="font-family:Poppins;">
                            {{ $products->name }}
                            <label class="label-stock bg-success">In Stock</label>
                        </h4>
                        <hr>
                        <p class="product-path" style="font-family:Poppins;">
                            Home / {{ $products->category->name }} / {{ $products->name }}
                        </p>
                        <p class="product-path">Brand : {{ $products->brand }}</p>
                        <div>
                            <span class="selling-price"style="font-weight:500; font-family:Poppins;"><span>₱
                                </span>{{ $products->selling_price }}.00</span>
                            <span class="original-price" style="font-weight:500; font-family:Poppins;"><span>₱
                                </span>{{ $products->original_price }}.00</span>
                        </div>
                        <div>
                            @if ($products->productColors->count() > 0)
                                @if ($products->productColors)
                                    @foreach ($products->productColors as $colorItem)
                                        {{-- <input type="radio" name="colorSelection" value="{{ $colorItem->id }}">
                                        {{ $colorItem->color->name }} --}}
                                        <label for="" class="colorSelectionLabel"
                                            style="background-color:{{ $colorItem->color->code }}; border-radius: 50%; height:20px; "
                                            wire:click="colorSelected({{ $colorItem->id }})">
                                            {{-- {{ $colorItem->color->name }} --}}
                                        </label>
                                    @endforeach
                                @endif

                                <div>
                                    @if ($this->prodColorSelectedQuantity == 'outOfStock')
                                        <label style="font-family:Poppins;"
                                            class="btn-sm py-1 mt-2 text-white badge rounded-pill text-bg-danger">Out
                                            of
                                            Stock</label>
                                    @elseif ($this->prodColorSelectedQuantity > 0)
                                        <label style="font-family:Poppins;"
                                            class="btn-sm py-1 mt-2 text-white badge rounded-pill text-bg-success">In
                                            Stock</label>
                                    @endif
                                </div>
                            @else
                                @if ($products->quantity)
                                    <label style="font-family:Poppins;"
                                        class="btn-sm py-1 mt-2 text-white label-stock bg-success">In Stock</label>
                                @else
                                    <label style="font-family:Poppins;"
                                        class="btn-sm py-1 mt-2 text-white label-stock bg-danger">Out of
                                        Stock</label>
                                @endif

                            @endif
                        </div>
                        <div class="mt-2">
                            <div class="input-group">
                                <span class="btn btn-outline-primary" wire:click="decrementQuantity"><i
                                        class="fa fa-minus"></i></span>
                                <input class="input text-center" style="font-weight:400; font-family:Poppins;"
                                    type="text" disabled wire:model="quantityCount"
                                    value="{{ $this->quantityCount }}" class="input-quantity" />
                                <span class="btn btn-outline-primary" wire:click="increementQuantity"><i
                                        class="fa fa-plus"></i></span>
                            </div>
                        </div>
                        <div class="mt-2">
                            <button type="button" wire:click="addToCart({{ $products->id }})" href=""
                                class="btn btn-outline-success">
                                <span wire:loading.remove>
                                    <i class="fa fa-shopping-cart"></i>
                                    Add To Cart
                                </span>
                                <span wire:loading wire:target="addToCart">
                                    Adding...
                                </span>
                            </button>
                            <button type="button" wire:click="addToWishList({{ $products->id }})"
                                class="btn btn-outline-primary">
                                <span wire:loading.remove>
                                    <i class="fa fa-heart"></i> Add To Wishlist
                                </span>
                                <span wire:loading wire:target="addToWishList">
                                    Adding...
                                </span>
                            </button>
                        </div>
                        <div class="mt-3">
                            <h5 class="mb-0" style=" font-family:Poppins;">Small Description</h5>
                            <p style="font-family:Cambria, Cochin, Georgia, Times, 'Times New Roman', serif">
                                {!! $products->small_description !!}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 mt-3">
                    <div class="card">
                        <div class="card-header bg-white">
                            <h4 style=" font-family:Poppins;">Description</h4>
                        </div>
                        <div class="card-body">
                            <p style="font-family:Cambria, Cochin, Georgia, Times, 'Times New Roman', serif">
                                {!! $products->description !!}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Related Products --}}
    <div class="py-3 py-md-5 bg-white">
        <div class="container">
            <div class="row">
                <div class="col-md-12 mb-3">
                    <h3>Related
                        @if ($category)
                            {{ $category->name }}
                        @endif
                        Products
                    </h3>
                    <div class="underline"></div>
                </div>

                <div class="col-md-12">
                    @if ($category)
                        <div class="owl-carousel owl-theme four-carousel">
                            @foreach ($category->relatedProducts as $relatedProductItem)
                                <div class="item mb-3">
                                    <div class="product-card">
                                        <div class="product-card-img">
                                            @if ($relatedProductItem->productImages->count() > 0)
                                                <a
                                                    href="{{ url('/collections/' . $relatedProductItem->category->slug . '/' . $relatedProductItem->slug) }}">
                                                    <img src="{{ asset($relatedProductItem->productImages[0]->image) }}"
                                                        alt="{{ $relatedProductItem->name }}" style=" height:200px;">
                                                </a>
                                            @endif
                                        </div>
                                        <div class="product-card-body">
                                            <p class="product-brand">{{ $relatedProductItem->brand }}</p>
                                            <h5 class="product-name">
                                                <a
                                                    href="{{ url('/collections/' . $relatedProductItem->category->slug . '/' . $relatedProductItem->slug) }}">
                                                    {{ $relatedProductItem->name }}
                                                </a>
                                            </h5>
                                            <div>
                                                <span class="selling-price"> <span
                                                        style="font-weight:500; font-family:Poppins;">₱</span>{{ $relatedProductItem->selling_price }}.00</span>
                                                <span class="original-price"><span
                                                        style="font-weight:500; font-family:Poppins;">₱</span>{{ $relatedProductItem->original_price }}.00</span>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center col-md-12 p-2">
                            <h4>
                                No Related Products Available !
                            </h4>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    {{-- Related Branding --}}
    <div class="py-3 py-md-5">
        <div class="container">
            <div class="row">
                <div class="col-md-12 mb-3">
                    <h3>Related
                        @if ($products)
                            {{ $products->brand }}
                        @endif
                        Brand Products
                    </h3>
                    <div class="underline"></div>
                </div>

                <div class="col-md-12">
                    @if ($category)
                        <div class="owl-carousel owl-theme four-carousel">
                            @foreach ($category->relatedProducts as $relatedProductItem)
                                @if ($relatedProductItem->brand == "$products->brand")
                                    <div class="item mb-3">
                                        <div class="product-card">
                                            <div class="product-card-img">
                                                @if ($relatedProductItem->productImages->count() > 0)
                                                    <a
                                                        href="{{ url('/collections/' . $relatedProductItem->category->slug . '/' . $relatedProductItem->slug) }}">
                                                        <img src="{{ asset($relatedProductItem->productImages[0]->image) }}"
                                                            alt="{{ $relatedProductItem->name }}"
                                                            style=" height:200px;">
                                                    </a>
                                                @endif
                                            </div>
                                            <div class="product-card-body">
                                                <p class="product-brand">{{ $relatedProductItem->brand }}</p>
                                                <h5 class="product-name">
                                                    <a
                                                        href="{{ url('/collections/' . $relatedProductItem->category->slug . '/' . $relatedProductItem->slug) }}">
                                                        {{ $relatedProductItem->name }}
                                                    </a>
                                                </h5>
                                                <div>
                                                    <span class="selling-price"> <span
                                                            style="font-weight:500; font-family:Poppins;">₱</span>{{ $relatedProductItem->selling_price }}.00</span>
                                                    <span class="original-price"><span
                                                            style="font-weight:500; font-family:Poppins;">₱</span>{{ $relatedProductItem->original_price }}.00</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    @else
                        <div class="text-center col-md-12 p-2">
                            <h4>
                                No Related Brand Available !
                            </h4>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Script for sweet alert notification delete --}}
<script type="text/javascript">
    // Store
    window.addEventListener('swal:store', event => {
        Swal.fire(
            'Success!',
            'Wishlist Added successfully',
            'success'
        )
    });
    // warning
    window.addEventListener('swal:warning', event => {
        Swal.fire(
            'Warning!',
            'Already added to wishlist!',
            'warning'
        )
    });
    // info
    window.addEventListener('swal:info', event => {
        Swal.fire(
            '',
            'Please Login to continue!',
            'info'
        )
    });
    // Cart notifier
    window.addEventListener('swal:addtocart', event => {
        Swal.fire(
            '',
            'Please Login to add to cart!',
            'info'
        )
    });
    window.addEventListener('swal:addedSuccessfully', event => {
        Swal.fire(
            '',
            'Product Added to Cart!',
            'success'
        )
    });
    window.addEventListener('swal:exists', event => {
        Swal.fire(
            '',
            'Product Already Added!',
            'success'
        )
    });
</script>
@push('scripts')
    <script>
        // For carousel picture
        $('.four-carousel').owlCarousel({
            loop: false,
            margin: 10,
            nav: true,
            responsive: {
                0: {
                    items: 1
                },
                600: {
                    items: 3
                },
                1000: {
                    items: 4
                }
            }
        })


        // For zooming picture
        $(function() {

            $("#exzoom").exzoom({
                "navWidth": 60,
                "navHeight": 60,
                "navItemNum": 5,
                "navItemMargin": 7,
                "navBorder": 1,
                "autoPlay": false,
                "autoPlayTimeout": 2000
            });

        });
    </script>
@endpush
