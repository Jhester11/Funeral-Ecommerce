<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title')</title>
    <link rel="shortcut icon" href="{{ asset('assets/img/mini-logo.png') }}" />
    @include('layouts.admin.inc.style')
    @livewireStyles
</head>

<body>
    @include('sweetalert::alert')
    <div class="container-scroller">
        @include('layouts.admin.inc.navbar')
        <div class="container-fluid page-body-wrapper">
            @include('layouts.admin.inc.sidebar')
            <div class="main-panel">
                <div class="content-wrapper">
                    @yield('content')
                </div>
            </div>
        </div>
    </div>
    @include('layouts.admin.inc.scripts')
    @stack('modals')
    @yield('scripts')
    @livewireScripts
    @stack('scripts')
    {{-- Sweet Alert --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    {{-- Script for modal --}}
    <script>
        window.addEventListener('modal', event => {
            $(event.detail.modalId).modal(event.detail.actionModal);
        })
    </script>
    {{-- Swal alert delete --}}
    <script>
        $('.delete').on('click', function(e) {
            e.preventDefault();
            var self = $(this);
            Swal.fire({
                title: 'Are you sure you want to delete this data?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire(
                        'Deleted!',
                        'Your product has been deleted.',
                        'success'
                    )
                    location.href = self.attr('href');
                }
            });
        });
    </script>
</body>

</html>
