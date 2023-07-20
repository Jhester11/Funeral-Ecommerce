@extends('layouts.frontend.frontend-app')
@section('title', 'View Products')

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
    <livewire:funeral.frontend.product.view-index :category="$category" :products="$products"></livewire:funeral.frontend.product.view-index>
@endsection
