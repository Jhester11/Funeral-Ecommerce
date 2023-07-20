@extends('layouts.frontend.frontend-app')

@section('title', 'Search Products')

@section('content')
    <div class="py-3 bg-white">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-10">
                    <h4>Search Results</h4>
                    <div class="underline"></div>
                </div>

                @forelse ($searchProducts as $productsItem)
                    <div class="col-md-10">
                        <div class="product-card">
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="product-card-img">
                                        <label class="stock bg-success">New</label>
                                        @if ($productsItem->productImages->count() > 0)
                                            <a
                                                href="{{ url('/collections/' . $productsItem->category->slug . '/' . $productsItem->slug) }}">
                                                <img src="{{ asset($productsItem->productImages[0]->image) }}"
                                                    alt="{{ $productsItem->name }}" style=" height:200px;">
                                            </a>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-9">
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
                                        <p style="height: 45px; overflow:hidden;">
                                            <b>Description : </b> {{ $productsItem->description }}
                                        </p>
                                        <a href="{{ url('/collections/' . $productsItem->category->slug . '/' . $productsItem->slug) }}" class="btn btn-outline-primary "> View</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="text-center col-md-12 p-2">
                        <h4>
                            No such Products Found !
                        </h4>
                    </div>
                @endforelse

                <div class="mt-3 d-flex justify-content-center">
                    {{ $searchProducts->appends(request()->input())->links() }}
                </div>

            </div>
        </div>
    </div>
@endsection
