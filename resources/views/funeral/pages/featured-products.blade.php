@extends('layouts.frontend.frontend-app')

@section('title', 'Featured Products')

@section('content')
    <div class="py-3 bg-white">
        <div class="container">
            <div class="row ">
                <div class="col-md-12">
                    <h4>Featured Products</h4>
                    <div class="underline"></div>
                </div>

                @forelse ($featuredProducts as $productsItem)
                    <div class="col-md-3">
                        <div class="product-card">
                            <div class="product-card-img">
                                {{-- @if ($productsItem->quantity > 6)
                                            <label class="stock bg-success">In Stock</label>
                                        @elseif($productsItem->quantity > 3)
                                            <label class="stock bg-info">Low Stock</label>
                                        @else
                                            <label class="stock bg-danger">Out of Stock</label>
                                        @endif --}}
                                <label class="stock bg-danger">Featured </label>
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
                    <div class="text-center col-md-12 p-2">
                        <h4>
                            No Featured Products Available !
                        </h4>
                    </div>
                @endforelse

                <div class="text-center">
                    <a href="{{ url('collections') }}" class="btn btn-primary px-3 text-white">View More</a>
                </div>

            </div>
        </div>
    </div>
@endsection
