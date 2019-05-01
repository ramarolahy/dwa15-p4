<div class="mdl-layout mdl-js-layout mdl-layout--fixed-header container">
    <div class="mdl-layout__header">
        <div class="mdl-layout__header-row">
            <a href="{{ route('quotes.home') }}"><span class="mdl-layout-title">Get Inspired</span></a>
            <nav class="float-right ml-auto mdl-navigation mdl-layout--large-screen-only">
                <a class="mdl-navigation__link" href="{{ route('quotes.home') }}">Quotes</a>
                <a class="mdl-navigation__link" href="{{ route('quotes.create') }}">Create New</a>
            </nav>
            {{-- Spacer to alight nav to the left --}}
            <div class="mdl-layout-spacer"></div>
            <!-- Navigation. We hide it in small screens. -->
            {{--                    These will be implemented for projet 4                  --}}
            {{--                <nav class="mdl-navigation mdl-layout--large-screen-only">--}}
            {{--                <a class="mdl-navigation__link" href="#">Signup</a>--}}
            {{--                <a class="mdl-navigation__link" href="#">Login</a>--}}
            {{--                <a class="mdl-navigation__link" href="#">Logout</a>--}}
            {{--                </nav>--}}
        </div>
    </div>
</div>

