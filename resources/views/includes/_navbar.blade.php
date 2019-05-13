<div class="navbar-prettyquotes mdl-layout mdl-js-layout">
    <div class="container">
        <header class="mdl-layout__header">
            <div class="mdl-layout__header-row">
                <a href="{{ route('home') }}"><span class="mdl-layout-title">Pretty quotes <span class="title-for">for&nbsp;{{ $user ? $user->first_name : 'you' }}</span>
                    </span></a>
                <div class="row-navigation row-navigation__pages">
                    <a class="mdl-button navigation navigation-quotes mx-2 {{\Route::current()->getName() === 'home' ? 'active' : null}} " href="{{ route('home') }}">Home</a>
                    @if(Auth::check ())
                        <a class="mdl-button navigation navigation-create mx-2 {{\Route::current()->getName() === 'create' ||\Route::current()->getName() === 'new.get' ||\Route::current()->getName() === 'new.post' ||\Route::current()->getName() ===  'edit.get' || \Route::current()->getName() === 'edit.post' ? 'active' : null }}" href="{{ route('create') }}">
                            Print shop
                        </a>
                    @endif
                </div>
                <div class="row-navigation row-navigation__auth">
                    @guest
                        <a class="mdl-button navigation navigation-login mx-2 {{Route::current()->getName() === 'login' ? 'active' : null}} " href="{{ route('login') }}">Login</a>
                        <a class="mdl-button navigation navigation-signup mx-2 {{Route::current()->getName() === 'register' ? 'active' : null}}" href="{{ route('register') }}">Register</a>
                    @else
                        <a class="mdl-button navigation navigation-logout mx-2"
                           onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
                    @endguest
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </div>
            </div>
        </header>
    </div>
</div>

