@extends('layouts.app')

@section('content')
{{--<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Login') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Login') }}
                                </button>

                                @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>--}}

<div class="auth-layout-wrap" style="background-image: url(../../dist-assets/images/log2.jpg)">
    <div class="auth-content">
        <div class="card o-hidden">
            <div class="row">
                <div class="col">
                    <div class="p-4">
                        <div class="auth-logo text-center mb-4"><img src="../../dist-assets/images/logo.png" alt=""></div>
                        <h1 class="mb-3 text-36 text-center">Вход</h1>

                        <form method="POST" action="{{ route('login') }}">

                            @csrf
                            <div class="form-group">
                                <label for="login">{{ __('Email or Username') }}</label>
                                <input id="login" type="login" class="form-control form-control-rounded @error('login') is-invalid @enderror" name="login" value="{{ old('login') }}" required autocomplete="email" autofocus>
                                <div class="col-md-6">
                                    @error('login')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="password">{{ __('Password') }}</label>
                                <input id="password" type="password" class="form-control form-control-rounded @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                                <div class="col-md-6">

                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                                    <button type="submit" class="btn btn-rounded btn-primary btn-block mt-2">{{ __('Войти') }}</button>
                                        @if (Route::has('password.request'))
                                            <a class="btn btn-link" href="{{ route('password.request') }}">
                                                {{ __('Forgot Your Password?') }}
                                            </a>
                                        @endif
                        </form>

                                <div class="col-md-6">
                                    <a href="{{ route('pageRegistration') }}">
                                    <button class="btn btn-rounded btn-primary btn-block mt-2">
                                        {{ __('Register') }}
                                    </button>
                                    </a>
                                </div>
                </div>
            </div>
        </div>
    </div>
</div>

    {{--<div class="form-group row">
        <label for="login" class="col-sm-4 col-form-label text-md-right">
            {{ __('Email or Username') }}
        </label>
        <div class="col-md-6">
            <input id="login" type="text"
                   class="form-control{{ $errors->has('login') ? ' is-invalid' : '' }}"
                   name="login" value="{{ old('login') }}" required autofocus>

            @if ($errors->has('login'))
                <span class="invalid-feedback">
                <strong>{{ $errors->first('login') }}</strong>
            </span>
            @endif
        </div>
    </div>--}}
@endsection
