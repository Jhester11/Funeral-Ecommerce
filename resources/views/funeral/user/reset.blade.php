<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/admin-custom.css') }}">
    
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="{{ asset('assets/frontend/custom.css') }}">
    <title>{{ config('app.name', 'Laravel') }}</title>
</head>

<body>
    <div id="app">
        {{-- @include('layouts.frontend.inc.navbar') --}}

        <main class="py-4">
            @yield('content')
        </main>
    </div>

    <form method="POST" action="{{ route('user.reset.password') }}">
        @csrf
        <input type="hidden" name="token" value="{{ $token }}">
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
                        <img class="secure-login" src="{{ asset('assets/img/reset.svg') }}" alt="Login">
                    </div>
                    <div class="card-body">
                        <h4 class="title text-center mt-4">
                            Reset Password
                        </h4>

                        <form class="form-box px-3 ">
                            <div class="form-input form-group" style="margin-bottom:30px">
                                <span><i class='bx bxs-envelope'></i></span>
                                <input placeholder="Email Address" type="email"
                                    class="form-control @error('email') is-invalid @enderror" name="email"
                                    value="{{ $email ?? old('email') }}" required  autofocus>
                            </div>
                            <div class="mx-auto col-md-5" style="margin-top: -15px; margin-bottom:10px">
                                <span class="text-danger ">
                                    @error('email')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </div>
                            <div class="form-input form-group" style="margin-bottom: 30px">
                                <span><i class='bx bxs-lock'></i></span>
                                <input placeholder="Password" id="password" type="password" class="form-control "
                                    name="password" required autocomplete="new-password" value="{{ old('password') }}">
                            </div>
                            <div class="mx-auto col-md-7" style="margin-top: -15px; margin-bottom:10px">
                                <span class="text-danger ">
                                    @error('password')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </div>
                            <div class="form-input form-group" style="margin-bottom: 30px">
                                <span><i class='bx bx-key'></i></span>
                                <input placeholder="Confirm Password" id="password-confirm" type="password"
                                    class="form-control" name="password_confirmation" required
                                    autocomplete="new-password" value="{{ old('password_confirmation') }}">
                            </div>
                            <div class="mx-auto col-md-10" style="margin-top: -15px; margin-bottom:10px">
                                <span class="text-danger ">
                                    @error('password_confirmation')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </div>


                            <div class="row mb-3">
                                <button type="submit" class="btn btn-primary">
                                    Reset Password
                                </button>
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
