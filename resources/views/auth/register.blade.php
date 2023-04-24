@extends('layouts.app')

@section('content')
{{--<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Register') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

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
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-end">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Register') }}
                                </button>
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
                    <div class="col-xl-12 pa-0">
                <div class="auth-form-wrap py-xl-0 py-50">
                    <div class="auth-form w-xxl-55 w-xl-75 w-sm-90 w-100">
                        <form action="" method='POST'>
                            @csrf
                            <h1 class="display-4 mb-10">Зарегистрироваться</h1>
                            <p class="mb-30">Создайте новый аккаунт чтобы пользоваться возможностями стенда</p>
                            <div class="form-row">
                                <div class="col-md-6 form-group">
                                    <input class="form-control" name="name" placeholder="First name" value="" type="text">
                                </div>
                                <div class="col-md-6 form-group">
                                    <input class="form-control" name="prename"  placeholder="Last name" value="" type="text">
                                </div>
                            </div>
                            <div class="form-group">
                                <input class="form-control"  name="email" placeholder="Email" type="email">
                            </div>
                            <div class="form-group">
                                <select class="btn border-primary col-md-12 dropdown-toggle" name="congregation">
                                    <option>Select congregation</option>
                                    @foreach($congregations as $congregation)
                                        <option value="{{ $congregation->id }}">{{ $congregation->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <input class="form-control"  name="password" placeholder="Password" type="password">
                            </div>
                            <div class="form-group">
                                <div class="input-group">
                                    <input class="form-control" name="remember_password"  placeholder="Confirm Password" type="password">
                                    <div class="input-group-append">
                                        <span class="input-group-text"><span class="feather-icon"><i data-feather="eye-off"></i></span></span>
                                    </div>
                                </div>
                            </div>
                            <div class="custom-control custom-checkbox mb-25">
                                <input class="custom-control-input" id="same-address" type="checkbox" checked>
                                <label class="custom-control-label font-14" for="same-address">I have read and agree to the <a href=""><u>term and conditions</u></a></label>
                            </div>
                            <button class="btn btn-primary btn-block" type="submit">Register</button>

                            <p class="text-center">Already have an account? <a href="{{ route('login') }}">Sign In</a></p>
                        </form>
                    </div>
                </div>
            </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
