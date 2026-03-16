<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>@yield('title') - {{ config('app.name') }}</title>

    @stack('customcss')
    {{-- Include styles --}}
    @include('components.layouts.includes.styles')
    @livewireStyles
</head>

<body>
    {{-- <script src="assets/static/js/initTheme.js"></script> --}}
    <div id="app">
        {{-- Include sweetalert2 --}}
        @include('sweetalert::alert')

        {{-- Include sidebar --}}
        @include('components.layouts.partials.sidebar')

        <div id="main">
            <header class="mb-3">
                <a href="#" class="burger-btn d-block d-xl-none">
                    <i class="bi bi-justify fs-3"></i>
                </a>
            </header>

            <div class="page-heading">
                <h3>@yield('title')</h3>
            </div>
            <div class="page-content">
                {{ $slot }}
            </div>

            {{-- Include footer --}}
            @include('components.layouts.partials.footer')

        </div>
    </div>
    {{-- Include Scripts --}}
    @include('components.layouts.includes.scripts')
    @stack('customjs')
    @livewireScripts
</body>

</html>
