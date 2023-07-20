<div>
    <div class="row">
        <div class="col-md-3">
            {{-- Brands --}}
            @if ($category->brands)
                <div class="card">
                    <div class="card-header" style="font-family: Poppins">
                        <h5>Brands</h5>
                    </div>
                    <div class="card-body" style="font-family: Poppins; font-weigth:200; color:rgb(136, 133, 133)">
                        @foreach ($category->brands as $brandItem)
                            <label class="d-block ">
                                <input wire:model="brandInputs" type="checkbox" value="{{ $brandItem->name }}">
                                {{ $brandItem->name }}
                            </label>
                        @endforeach
                    </div>
                </div>
            @endif
            {{-- Price --}}
            <div class="card mt-3">
                <div class="card-header" style="font-family: Poppins">
                    <h4>Price</h4>
                </div>
                <div class="card-body" style="font-family: Poppins; font-weigth:200; color:rgb(136, 133, 133)">
                    <label class="d-block">
                        <input type="radio" name="priceSort" wire:model="priceInput" value="high-to-low"> High to Low
                    </label>
                    <label class="d-block">
                        <input type="radio" name="priceSort" wire:model="priceInput" value="low-to-high"> Low to High
                    </label>
                </div>
            </div>
        </div>

        <div class="col-md-9">
            <div class="row">
                @forelse ($products as $productsItem)
                    <div class="col-md-4">
                        <div class="product-card">
                            <div class="product-card-img">
                                @if ($productsItem->quantity > 6)
                                    <label class="stock bg-success">In Stock</label>
                                @elseif($productsItem->quantity > 3)
                                    <label class="stock bg-info">Low Stock</label>
                                @else
                                    <label class="stock bg-danger">Out of Stock</label>
                                @endif

                                @if ($productsItem->productImages->count() > 0)
                                    <a
                                        href="{{ url('/collections/' . $productsItem->category->slug . '/' . $productsItem->slug) }}">
                                        <img src="{{ asset($productsItem->productImages[0]->image) }}"
                                            alt="{{ $productsItem->name }}" style=" height:200px;">
                                    </a>
                                @endif
                            </div>
                            <div class="product-card-body">
                                <p class="product-brand">{{ $productsItem->brand }}</p>
                                <h5 class="product-name">
                                    <a
                                        href="{{ url('/collections/' . $productsItem->category->slug . '/' . $productsItem->slug) }}">
                                        {{ $productsItem->name }}
                                    </a>
                                </h5>
                                <div>
                                    <span class="selling-price"> <span
                                            style="font-weight:500; font-family:Poppins;">₱</span>{{ $productsItem->selling_price }}.00</span>
                                    <span class="original-price"><span
                                            style="font-weight:500; font-family:Poppins;">₱</span>{{ $productsItem->original_price }}.00</span>
                                </div>

                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-md-12">
                        <div class="p-2">
                            <h4>
                                No Products Available for {{ $category->name }}!
                            </h4>
                        </div>
                    </div>
                @endforelse
            </div>
        </div>
    </div>

</div>
