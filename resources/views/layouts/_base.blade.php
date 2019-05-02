<!doctype html>
<html lang="{{ app ()->getLocale () }}">
<head>
    @include('includes._head')
    <title>Pretty Quotes - @yield('title')</title>
</head>
<body>
@include('includes._navbar')
<main class="container">
    <div class="card card-main py-3 px-5 border-0 bg-light mdl-shadow--2dp">
    @yield('content')
    </div>
</main>

@yield ('script')

</body>
</html>
