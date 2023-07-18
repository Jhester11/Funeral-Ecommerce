@extends('layouts.admin.admin-app')
@section('title', 'Dashboard')
@section('content')
    {{-- header --}}
    <div class="col-md-12 grid-margin">
        <div class="d-flex justify-content-between flex-wrap">
            <div class="d-flex align-items-end flex-wrap">
                <div class="me-md-3 me-xl-5">
                    <h3>Welcome back,</h3>
                    <p class="mb-md-0">Your analytics dashboard .</p>
                </div>
                <div class="d-flex">
                    <i class="mdi mdi-home text-muted hover-cursor"></i>
                    <p class="text-muted mb-0 hover-cursor">&nbsp;/&nbsp;Dashboard &nbsp;/&nbsp;</p>
                    <p class="text-primary mb-0 hover-cursor"> Analytics</p>
                </div>
            </div>
            {{-- <div class="d-flex justify-content-between align-items-end flex-wrap">
            <a href="{{ url('superadmin/products') }}" class="btn btn-danger float-end text-white">
                Back
            </a>
        </div> --}}
        </div>
        <hr>
    </div>

    <div class="row">
        {{-- superadmin --}}
        <div class="col-md-3 mb-2">
            <div style="border:1px solid lightblue; border-radius:15px"
                class="d-flex border-md-right flex-grow-1 align-items-center justify-content-center p-3 item">
                <i class="mdi mdi-account-key me-3 icon-lg text-secondary"></i>
                <div class="d-flex flex-column justify-content-around">
                    <small class="mb-1 text-muted"> Superadmin </small>
                    {{-- <h5 class="me-2 mb-0"> {{ $totalSuperadmin }} </h5> --}}
                </div>
            </div>
        </div>
        {{-- Admin --}}
        <div class="col-md-3 mb-2">
            <div style="border:1px solid lightblue; border-radius:15px"
                class="d-flex border-md-right flex-grow-1 align-items-center justify-content-center p-3 item">
                <i class="mdi mdi-account-check me-3 icon-lg text-secondary"></i>
                <div class="d-flex flex-column justify-content-around">
                    <small class="mb-1 text-muted"> Admin </small>
                    {{-- <h5 class="me-2 mb-0"> {{ $totalAdmin }} </h5> --}}
                </div>
            </div>
        </div>
        {{-- User --}}
        <div class="col-md-3 mb-2">
            <div style="border:1px solid lightblue; border-radius:15px"
                class="d-flex border-md-right flex-grow-1 align-items-center justify-content-center p-3 item">
                <i class="mdi mdi-account me-3 icon-lg text-secondary"></i>
                <div class="d-flex flex-column justify-content-around">
                    <small class="mb-1 text-muted"> User </small>
                    {{-- <h5 class="me-2 mb-0"> {{ $totalUser }} </h5> --}}
                </div>
            </div>
        </div>
        {{-- Total Products --}}
        <div class="col-md-3 mb-2">
            <div style="border:1px solid lightblue; border-radius:15px"
                class="d-flex border-md-right flex-grow-1 align-items-center justify-content-center p-3 item">
                <i class="mdi mdi-format-list-bulleted-type me-3 icon-lg text-info"></i>
                <div class="d-flex flex-column justify-content-around">
                    <small class="mb-1 text-muted"> Total Products </small>
                    {{-- <h5 class="me-2 mb-0"> {{ $totalProducts }} </h5> --}}
                </div>
            </div>
        </div>
        {{-- Total Categories --}}
        <div class="col-md-3 mb-2">
            <div style="border:1px solid lightblue; border-radius:15px"
                class="d-flex border-md-right flex-grow-1 align-items-center justify-content-center p-3 item">
                <i class="mdi mdi-book-multiple me-3 icon-lg text-info"></i>
                <div class="d-flex flex-column justify-content-around">
                    <small class="mb-1 text-muted"> Total Category </small>
                    {{-- <h5 class="me-2 mb-0"> {{ $totalCategories }} </h5> --}}
                </div>
            </div>
        </div>
        {{-- Total Brand --}}
        <div class="col-md-3 mb-2">
            <div style="border:1px solid lightblue; border-radius:15px"
                class="d-flex border-md-right flex-grow-1 align-items-center justify-content-center p-3 item">
                <i class="mdi mdi-book-open me-3 icon-lg text-info"></i>
                <div class="d-flex flex-column justify-content-around">
                    <small class="mb-1 text-muted"> Total Brand </small>
                    {{-- <h5 class="me-2 mb-0"> {{ $totalBrands }} </h5> --}}
                </div>
            </div>
        </div>
        {{-- Total Order --}}
        <div class="col-md-3 mb-2">
            <div style="border:1px solid lightblue; border-radius:15px"
                class="d-flex border-md-right flex-grow-1 align-items-center justify-content-center p-3 item">
                <i class="mdi mdi-package-variant-closed me-3 icon-lg text-primary"></i>
                <div class="d-flex flex-column justify-content-around">
                    <small class="mb-1 text-muted"> Total Order </small>
                    {{-- <h5 class="me-2 mb-0"> {{ $totalOrder }} </h5> --}}
                </div>
            </div>
        </div>
        {{-- Total Order --}}
        <div class="col-md-3 mb-2">
            <div style="border:1px solid lightblue; border-radius:15px"
                class="d-flex border-md-right flex-grow-1 align-items-center justify-content-center p-3 item">
                <i class="mdi mdi-package me-3 icon-lg text-success"></i>
                <div class="d-flex flex-column justify-content-around">
                    <small class="mb-1 text-muted"> Today Order </small>
                    {{-- <h5 class="me-2 mb-0"> {{ $todayOrder }} </h5> --}}
                </div>
            </div>
        </div>
        {{-- Total Order --}}
        <div class="col-md-3 mb-2">
            <div style="border:1px solid lightblue; border-radius:15px"
                class="d-flex border-md-right flex-grow-1 align-items-center justify-content-center p-3 item">
                <i class="mdi mdi-paper-cut-vertical me-3 icon-lg text-warning"></i>
                <div class="d-flex flex-column justify-content-around">
                    <small class="mb-1 text-muted"> Month Order </small>
                    {{-- <h5 class="me-2 mb-0"> {{ $thisMonthOrder }} </h5> --}}
                </div>
            </div>
        </div>
        {{-- Total Order --}}
        <div class="col-md-3 mb-2">
            <div style="border:1px solid lightblue; border-radius:15px"
                class="d-flex border-md-right flex-grow-1 align-items-center justify-content-center p-3 item">
                <i class="mdi mdi-paper-cut-vertical me-3 icon-lg text-danger"></i>
                <div class="d-flex flex-column justify-content-around">
                    <small class="mb-1 text-muted"> Year Order </small>
                    {{-- <h5 class="me-2 mb-0"> {{ $thisYearOrder }} </h5> --}}
                </div>
            </div>
        </div>
        {{-- Sales --}}
        <div class="col-md-3 mb-2">
            <div style="border:1px solid lightblue; border-radius:15px"
                class="d-flex border-md-right flex-grow-1 align-items-center justify-content-center p-3 item">
                <i class="mdi mdi-paper-cut-vertical me-3 icon-lg text-danger"></i>
                <div class="d-flex flex-column justify-content-around">
                    <small class="mb-1 text-muted"> Sales </small>
                    {{-- <h5 class="me-2 mb-0"> {{ $totalAmount }} </h5> --}}
                </div>
            </div>
        </div>
    </div>
@endsection
