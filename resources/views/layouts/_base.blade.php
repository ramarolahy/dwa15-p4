<!doctype html>
<html lang="{{ app ()->getLocale () }}">
<head>
    @include('includes._head')
    <title>Pretty Quotes - @yield('title')</title>
</head>
<body>
<header class="mdl-layout__fixed-header">
    @include('includes._navbar')
</header>

<div class="mdl-layout mdl-js-layout mdl-layout--fixed-header">
    <main class="container pt-5">
        @yield('content')
    </main>
</div>

@yield ('script')

</body>
</html>
