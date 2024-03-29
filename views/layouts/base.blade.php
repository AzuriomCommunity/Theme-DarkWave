<!DOCTYPE html>
@include('elements.base')
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="@yield('description', setting('description', ''))">
    <meta name="theme-color" content="{{ theme_config('color', '#f6ca60') }}">
    <meta name="author" content="Azuriom">

    <meta property="og:title" content="@yield('title')">
    <meta property="og:type" content="@yield('type', 'website')">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:image" content="{{ favicon() }}">
    <meta property="og:description" content="@yield('description', setting('description', ''))">
    <meta property="og:site_name" content="{{ site_name() }}">
    @stack('meta')

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title') | {{ site_name() }}</title>

    <!-- Favicon -->
    <link rel="shortcut icon" href="{{ favicon() }}">

    <!-- Scripts -->
    <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}" defer></script>
    <script src="{{ asset('vendor/axios/axios.min.js') }}" defer></script>
    <script src="{{ asset('js/script.js') }}" defer></script>
    <script src="{{ theme_asset('js/clipboard.js') }}" defer></script>

    <!-- Page level scripts -->
    @stack('scripts')

    <!-- Fonts -->
    <link href="https://fonts.bunny.net/css?family=Rubik:400,500,700&display=swap" rel="stylesheet">
    <link href="{{ asset('vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/base.css') }}" rel="stylesheet">
    <link href="{{ theme_asset('css/style.css') }}" rel="stylesheet">
    @stack('styles')
    @include('elements.theme-color', ['color' => theme_config('color', '#f6ca60')])
</head>

<body data-bs-theme="dark">
<div id="app">
    @yield('app')
</div>

<footer class="footer bg-body @if($isHome ?? false) home-footer mt-0 pt-3 @else pt-5 @endif">
    <div class="container">
        @if(!Route::is('home'))
            <div class="row mb-5">
                <div class="col-md-5 text-center">
                    @if(setting('logo'))
                        <img class="logo mb-4 img-fluid" src="{{ image_url(setting('logo')) }}" alt="Logo">
                    @endif
                </div>
                <div class="col-md-7">
                    <h3 class="text-center">{{ site_name() }}</h3>
                    <p class="mb-4">{{ theme_config('footer_description') }}</p>

                    <div class="list-inline text-center social-links">
                        @foreach(social_links() as $link)
                            <a href="{{ $link->value }}" class="list-inline-item mx-2" title="{{ $link->title }}" data-bs-toggle="tooltip" target="_blank" rel="noopener noreferrer">
                                <i class="{{ $link->icon }} fs-2"></i>
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>
        @endif

        <ul class="list-inline text-center text-uppercase footer-links">
            @foreach(theme_config('footer_links') ?? [] as $link)
                <li class="list-inline-item">
                    <a href="{{ $link['value'] }}">
                        {{ $link['name'] }}
                    </a>
                </li>
            @endforeach
        </ul>
    </div>

    <div class="text-bg-primary py-4">
        <div class="container text-center">
            <p class="mb-1">{{ setting('copyright') }}</p>
            <p class="small mb-0">
                @lang('messages.copyright')
            </p>
        </div>
    </div>
</footer>

@stack('footer-scripts')

</body>
</html>
