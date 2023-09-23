<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>@yield('title') - Spp Online</title>

    @stack('customcss')
    {{-- Include styles --}}
    @include('adminpanel.includes.styles')
</head>

<body>
    <script src="assets/static/js/initTheme.js"></script>
    <div id="app">
        {{-- Include sweetalert2 --}}
        @include('sweetalert::alert')

        {{-- Include sidebar --}}
        @include('adminpanel.components.sidebar')

        <div id="main">
            {{-- Include header --}}
            @include('adminpanel.components.header')

            <div class="page-heading">
                <h3>@yield('title')</h3>
            </div>
            <div class="page-content">
                @yield('content')
            </div>

            {{-- Include footer --}}
            @include('adminpanel.components.footer')
        </div>
    </div>
    {{-- Include Scripts --}}
    @include('adminpanel.includes.scripts')
    @stack('customjs')
</body>

</html>
