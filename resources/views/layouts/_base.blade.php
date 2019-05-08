<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    @include('includes._head')
    <title>Pretty Quotes - @yield('title')</title>
</head>
<body>
@include('includes._navbar')
<main class="container">
    @if (\Request::is('login') or \Request::is('register') or \Request::is('password/*'))
        <div class="card card-main--auth py-3 px-3 border-0 bg-light mdl-shadow--2dp">
            @yield('content')
        </div>
    @else
        <div class="card card-main py-3 px-3 border-0 bg-light mdl-shadow--2dp">
            @yield('content')
        </div>
    @endif
</main>

@yield ('script')

</body>
</html>
