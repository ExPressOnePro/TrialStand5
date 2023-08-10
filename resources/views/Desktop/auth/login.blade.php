@extends('Desktop.layouts.auth')
@section('title') Meeper | Авторизация @endsection
@section('content')
    @include('includes.guest.header')

    @if (session('error'))
        <div class="alert alert-card alert-danger">
            {{ session('error') }}
        </div>
    @endif

    @if (session('success'))
        <div class="alert alert-card alert-success">
            {{ session('success') }}
        </div>
    @endif
        <div class="auth-layout-wrap">
            <div class="auth-content">
                <div class="card o-hidden">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="p-4">
                                <div class="auth-logo text-center mb-4"><img src="../../dist-assets/images/logo.png" alt=""></div>
                                <h1 class="mb-3 text-36 text-center">{{ __('constant.signin') }}</h1>
                                <form method="POST" action="{{ route('login') }}">
                                    @csrf
                                    <div class="form-group">
                                        <label for="login">{{ __('constant.Email or Login') }}</label>
                                        <input id="login" type="login" name="login" class="form-control form-control-rounded @error('login') is-invalid @enderror"  value="{{ old('login') }}" required autocomplete="email" autofocus>
                                        <div class="col-md-6">
                                            @error('login')
                                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="password">{{ __('text.Password') }}</label>
                                        <input id="password" type="password" class="form-control form-control-rounded @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                                        <div class="col-md-6">

                                            @error('password')
                                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-12">
                                            <button type="submit" class="btn btn-rounded btn-primary btn-block mt-2">{{ __('constant.Enter') }}</button>

{{--                                            @if (Route::has('password.reset'))--}}
                                                <a class="btn btn-link heading" href="{{ route('password.selectLogin') }}">
                                                    {{ __('text.Forgot your password?') }}
                                                </a>
{{--                                            @endif--}}
                                        </div>

                                    </div>
                                </form>
                                <div class="row">
                                    <div class="col-md-6">
                                    </div>
                                    <div class="col-md-6">
                                        <a href="{{ '/registration' }}">
                                            <button class="btn btn-rounded btn-primary btn-block mt-2">
                                                {{ __('Регистрация') }}
                                            </button>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
@endsection
