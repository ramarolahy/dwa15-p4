@extends('layouts._base')

@section('title', 'Login')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card form-auth mdl-shadow--2dp">
                <div class="card-header card-header__auth">{{ __('Login') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email"  autocomplete="on" value="{{ old('email') }}" required autofocus>

                                @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password"  autocomplete="off" required>

                                @if ($errors->has('password'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="offset-4 col-md-6">
                                <p class="text-center">Still need an account? <a href="/register">Register</a></p>
                            </div>
                        </div>
                        {{--<div class="form-group row">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>
                        </div>--}}

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="w-100 text-white mdl-button mdl-js-button mdl-button--raised mdl-button--accent">
                                    {{ __('Login') }}
                                </button>
                                {{--@if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif--}}
                            </div>
                        </div>
                    </form>
                </div>
                <div class="row row--bottom-quote--auth px-5 mt-4 mb-2 bg-light border-1">
                    <div class=" col--bottom-quote border-1 col-12">
                        <h6 id="bottom_quote" class="text-center py-0 mx-auto my-2">
                            “Nothing is impossible, the word itself says 'I'm possible'!”<br>
                            <em>- Audrey Hepburn -</em>
                        </h6>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
