@extends('layouts.frontend.frontend-app')

@section('title', 'Home')

@section('content')
    <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="false">
        
        @foreach ($sliders as $key => $sliderItem)
            <div class="carousel-inner d-block " style="height: 300px; overflow: hidden;">
                <div class="carousel-item {{ $key == 0 ? 'active' : '' }}">
                    @if ($sliderItem->image)
                        <img src="{{ asset("$sliderItem->image") }}" style="height: 300px; object-fit: cover; width: 100%;"
                            class="d-block w-100" alt="SliderImage">
                    @endif
                    <div class="carousel-caption d-none d-md-block">
                        <div class="custom-carousel-content">
                            <h1>
                                {!! $sliderItem->title !!}
                            </h1>
                            <p>
                                {!! $sliderItem->description !!}
                            </p>
                            <div>
                                <a href="{{ url('/collections') }}" class="btn btn-slider">
                                    Get Now
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach

        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>

    <div class="py-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8 text-center">
                    <h4>Welcome to Funeral E-Commerce</h4>
                    <div class="underline mx-auto"></div>
                </div>
                <p>
                    Welcome to <span style="color: blue;">"Funeral E-commerce,"</span> where we understand the importance of honoring the memories of your loved ones.
                </p>
            </div>
        </div>
    </div>

    <div class="py-3 bg-white">
        <div class="container">
            <div class="row ">
                <div class="col-md-12">
                    <h4>Trending Products</h4>
                    <div class="underline "></div>
                </div>
                @if ($trendingProducts)
                    <div class="col-md-12">
                        <div class="owl-carousel owl-theme four-carousel">
                            @foreach ($trendingProducts as $productsItem)
                                <div class="item">
                                    <div class="product-card">
                                        <div class="product-card-img">
                                            {{-- @if ($productsItem->quantity > 6)
                                                <label class="stock bg-success">In Stock</label>
                                            @elseif($productsItem->quantity > 3)
                                                <label class="stock bg-info">Low Stock</label>
                                            @else
                                                <label class="stock bg-danger">Out of Stock</label>
                                            @endif --}}
                                            @if ($productsItem->trending = 1)
                                                <label class="stock bg-success">Trending</label>
                                            @else
                                                <label class="stock bg-danger">Not Trending</label>
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
                            @endforeach
                        </div>
                    </div>
                @else
                    <div class="col-md-12">
                        <div class="p-2">
                            <h4>
                                No Products Available !
                            </h4>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <div class="py-3 bg-white">
        <div class="container">
            <div class="row ">
                <div class="col-md-12">
                    <h4>New Arrivals
                        <a href="{{ url('new-arrivals') }}" class="btn btn-primary btn-sm text-white float-end">View
                            More</a>
                    </h4>
                    <div class="underline "></div>
                </div>
                @if ($newArrivalsProducts)
                    <div class="col-md-12">
                        <div class="owl-carousel owl-theme four-carousel">
                            @foreach ($newArrivalsProducts as $productsItem)
                                <div class="item">
                                    <div class="product-card">
                                        <div class="product-card-img">
                                            {{-- @if ($productsItem->quantity > 6)
                                                <label class="stock bg-success">In Stock</label>
                                            @elseif($productsItem->quantity > 3)
                                                <label class="stock bg-info">Low Stock</label>
                                            @else
                                                <label class="stock bg-danger">Out of Stock</label>
                                            @endif --}}
                                            @if ($productsItem->featured = 1)
                                                <label class="stock bg-primary">New</label>
                                            @else
                                                <label class="stock bg-success">Not arrival</label>
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
                            @endforeach
                        </div>
                    </div>
                @else
                    <div class="col-md-12">
                        <div class="p-2">
                            <h4>
                                No New Arrival Available !
                            </h4>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <div class="py-3 bg-white">
        <div class="container">
            <div class="row ">
                <div class="col-md-12">
                    <h4>Featured Products
                        <a href="{{ url('featured-products') }}" class="btn btn-primary btn-sm text-white float-end">View
                            More</a>
                    </h4>
                    <div class="underline "></div>
                </div>
                @if ($featuredProducts)
                    <div class="col-md-12">
                        <div class="owl-carousel owl-theme four-carousel">
                            @foreach ($featuredProducts as $productsItem)
                                <div class="item">
                                    <div class="product-card">
                                        <div class="product-card-img">
                                            {{-- @if ($productsItem->quantity > 6)
                                                <label class="stock bg-success">In Stock</label>
                                            @elseif($productsItem->quantity > 3)
                                                <label class="stock bg-info">Low Stock</label>
                                            @else
                                                <label class="stock bg-danger">Out of Stock</label>
                                            @endif --}}
                                            @if ($productsItem->trending = 1)
                                                <label class="stock bg-danger">Featured</label>
                                            @else
                                                <label class="stock bg-danger">Not Featured</label>
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
                            @endforeach
                        </div>
                    </div>
                @else
                    <div class="col-md-12">
                        <div class="p-2">
                            <h4>
                                No Featured Products Available !
                            </h4>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>

@endsection

@section('scripts')
    <script>
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
    </script>
@endsection
