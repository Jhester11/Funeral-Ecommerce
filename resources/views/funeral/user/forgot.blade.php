<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/admin-custom.css') }}">
    <link rel="shortcut icon" href="{{ asset('assets/img/mini-logo.png') }}" />
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="{{ asset('assets/frontend/custom.css') }}">
    <title>{{ config('app.name', 'Laravel') }}</title>
</head>

<body>
    <div id="app">
        <div class="main-navbar shadow-sm sticky-top">
            <div class="top-navbar">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-2 my-auto d-none d-sm-none d-md-block d-lg-block">
                            <h5 class="brand-name"><img style="width: 160px; height:90px;"
                                    src="{{ asset('assets/img/logo.png') }}" alt="Logo"></h5>
                        </div>
                        <div class="col-md-5 my-auto">
                            {{-- <form action="{{ url('search') }}" method="GET" role="search">
                                <div class="input-group">
                                    <input type="search" name="search" value="{{ Request::get('search') }}" placeholder="Search your product" class="form-control" />
                                    <button class="btn bg-info" type="submit">
                                        <i class="fa fa-search"></i>
                                    </button>
                                </div>
                            </form> --}}
                        </div>
                        <div class="col-md-5 my-auto">
                            <ul class="nav justify-content-end">
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ url('cart') }}">
                                        <i class="fa fa-shopping-cart"></i> Cart ()
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ url('wishlist') }}">
                                        <i class="fa fa-heart"></i> Wishlist ()
                                    </a>
                                </li>
                                @guest
                                    @if (Route::has('user.login'))
                                        <li class="nav-item">
                                            <a class="nav-link" href="{{ route('user.login') }}">{{ __('Login') }}</a>
                                        </li>
                                    @endif

                                    @if (Route::has('user.register'))
                                        <li class="nav-item">
                                            <a class="nav-link"
                                                href="{{ route('user.register') }}">{{ __('Register') }}</a>
                                        </li>
                                    @endif
                                @else
                                    <li class="nav-item dropdown">
                                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown"
                                            role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                            <i class="fa fa-user"></i> {{ Auth::user()->name }}
                                        </a>
                                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                            <li><a class="dropdown-item" href="{{ url('profile') }}"><i
                                                        class="fa fa-user"></i> Profile</a></li>
                                            <li><a class="dropdown-item" href="{{ url('orders') }}"><i
                                                        class="fa fa-list"></i> My Orders</a>
                                            </li>
                                            <li><a class="dropdown-item" href="{{ url('wishlist') }}"><i
                                                        class="fa fa-heart"></i> My Wishlist</a>
                                            </li>
                                            <li><a class="dropdown-item" href="{{ url('cart') }}"><i
                                                        class="fa fa-shopping-cart"></i> My
                                                    Cart</a></li>
                                            <li>
                                                <a class="dropdown-item" href="{{ route('user.logout') }}"
                                                    onclick="event.preventDefault();
                                                                document.getElementById('logout-form').submit();">
                                                    <i class="fa fa-sign-out"></i>
                                                    {{ __('Logout') }}
                                                </a>

                                                <form id="logout-form" action="{{ route('user.logout') }}" method="POST"
                                                    class="d-none">
                                                    @csrf
                                                </form>
                                            </li>
                                        </ul>
                                    </li>
                                @endguest
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <nav class="navbar navbar-expand-lg">
                <div class="container-fluid">
                    <a class="navbar-brand d-block d-sm-block d-md-none d-lg-none" href="#">
                        <img style="width: 160px; height:90px;" src="{{ asset('assets/img/logo.png') }}"
                            alt="Logo">
                    </a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                        data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                        aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                            <li class="nav-item">
                                <a class="nav-link" href="{{ url('/') }}">Home</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ url('/collections') }}">All Categories</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ url('/new-arrivals') }}">New Arrivals</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ url('featured-products') }}">Featured Products</a>
                            </li>

                        </ul>
                    </div>
                </div>
            </nav>
        </div>

        <main class="py-4">
            @yield('content')
        </main>
    </div>

    <form method="POST" action="{{ route('user.forgot.password.link') }}">
        @csrf

        <div class="container mt-lg-5">

            <div class="mx-auto text-center">
                @if (Session::get('info'))
                    <div class="alert alert-info">
                        {{ Session::get('info') }}
                    </div>
                @endif
                @if (Session::get('fail'))
                    <div class="alert alert-danger">
                        {{ Session::get('fail') }}
                    </div>
                @endif
            </div>

            <div class="row px-3">
                <div class="col-lg-10 col-xl-9 card flex-row mx-auto px-0">
                    <div class="img-left d-none d-md-flex">
                        <img class="secure-login" src="{{ asset('assets/img/forgotpassword.svg') }}" alt="Login">
                    </div>
                    <div class="card-body">
                        <h4 class="title text-center mt-4">
                            Forgot Password
                        </h4>
                        <p>
                            Enter your email address and we will send you a link to reset your password.
                        </p>
                        <form class="form-box px-3 ">
                            <div class="form-input form-group" style="margin-bottom:30px">
                                <span><i class='bx bxs-envelope'></i></span>
                                <input placeholder="Email Address" type="email"
                                    class="form-control @error('email') is-invalid @enderror" name="email"
                                    value="{{ old('email') }}" required autocomplete="email" autofocus>
                            </div>
                            <div class="mx-auto col-md-6" style="margin-top: -15px; margin-bottom:10px">
                                <span class="text-danger ">
                                    @error('email')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </div>
                            <div class="row mb-3">
                                <button type="submit" class="btn btn-primary">
                                    Send Reset Password
                                </button>
                            </div>

                            <div class="text-right">
                                <a href="{{ route('user.login') }}" >
                                    Login
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </form>
    <script src="{{ asset('assets/js/jquery-3.6.1.min.js') }}" defer></script>
    <script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}" defer></script>
</body>

</html>
