@extends('layouts._base')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card form-auth mdl-shadow--2dp">
                <div class="card-header card-header__auth">{{ __('Reset Password') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('password.update') }}">
                        @csrf

                        <input type="hidden" name="token" value="{{ $token }}">

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ $email ?? old('email') }}" required autofocus>

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
                                <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="text-white mdl-button mdl-js-button mdl-button--raised mdl-button--accent">
                                    {{ __('Reset Password') }}
                                </button>
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
            <div class="row row--bottom-quote--auth px-5">

            </div>
        </div>
    </div>

@stop
