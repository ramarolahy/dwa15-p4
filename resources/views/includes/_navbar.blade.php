<div class="mdl-layout mdl-js-layout container">
    <header class="mdl-layout__header mdl-layout__header--scroll">
        <div class="mdl-layout__header-row">
            <a href="{{ route('quotes.home') }}"><span class="mdl-layout-title">Pretty quotes</span></a>
            <div class="row-navigation row-navigation__pages">
                <a class="mdl-button navigation navigation-quotes mx-2 {{$isActive === 'home' ? 'active' : null}} " href="{{ route('quotes.home') }}">Quotes</a>
                <a class="mdl-button navigation navigation-create mx-2 {{$isActive === 'create' ? 'active' : null}}" href="{{ route('quotes.create') }}">Poster Maker</a>
            </div>
{{--            <div class="row-navigation row-navigation__auth">--}}
{{--                <a class="mdl-button navigation navigation-login mx-2 {{$isActive === 'login' ? 'active' : null}} " href="">Login</a>--}}
{{--                <a class="mdl-button navigation navigation-signup mx-2 {{$isActive === 'signup' ? 'active' : null}}" href="">Signup</a>--}}
{{--                <a class="mdl-button navigation navigation-logout mx-2 {{$isActive === 'logout' ? 'active' : null}}" href="">Logout</a>--}}
{{--            </div>--}}
        </div>
    </header>
</div>

