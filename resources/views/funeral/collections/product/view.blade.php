@extends('layouts.frontend.frontend-app')

@section('name')
    {{ $products->name }}
@endsection

@section('slug')
    {{ $products->slug }}
@endsection

@section('description')
    {{ $products->description }}
@endsection

@section('content')
    <livewire:frontend.product.view-index :category="$category" :products="$products"></livewire:frontend.product.view-index>
@endsection
