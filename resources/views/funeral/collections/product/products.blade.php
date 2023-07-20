@extends('layouts.frontend.frontend-app')
@section('title', 'Products')

@section('name')
    {{ $category->name }}
@endsection

@section('slug')
    {{ $category->slug }}
@endsection

@section('description')
    {{ $category->description }}
@endsection

@section('content')
    <div class="py-3 py-md-5 bg-light">
        <div class="container">
            <div class="row">
                <div class="col-md-12" >
                    <h3 class="mb-4" style="font-weight:800; font-family:Poppins;">Our Products</h3>
                </div>

                <livewire:funeral.frontend.product.product-index :category="$category"></livewire:funeral.frontend.product.product-index>
            </div>
        </div>
    </div>
@endsection
