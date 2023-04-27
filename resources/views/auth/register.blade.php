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
        <div class="card o-hidden align-items-center">
            <div class="row">
                <div class="col">
                    <div class="p-4">
                        {{--<div class="auth-logo text-center mb-4"><img src="../../dist-assets/images/logo.png" alt=""></div>--}}
                            <h1 class="mb-3 text-36 text-center">Регистрация</h1>
                            <p class="mb-30 text-center">Создайте новый аккаунт чтобы пользоваться возможностями стенда</p>
                            <form method="POST" action="{{ route('register') }}">
                                @csrf
                                <div class="form-row">
                                    <div class="form-group col-md-12">
                                        <input class="form-control form-control-rounded @error('email') is-invalid @enderror"  name="email" placeholder="Эл. адрес" type="email">
                                        <div class="col-md-6">
                                            @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-12">
                                        <input class="form-control form-control-rounded @error('name') is-invalid @enderror" name="name" placeholder="Имя и фамилия" value="" type="text">
                                        <div class="col-md-6">
                                            @error('name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-12">
                                        <input class="form-control form-control-rounded @error('login') is-invalid @enderror" name="login" placeholder="Имя пользователя" value="" type="text">
                                        <div class="col-md-6">
                                            @error('login')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-12">
                                        <input class="form-control form-control-rounded @error('password') is-invalid @enderror"  name="password" placeholder="Password" type="password">
                                        <div class="col-md-6">
                                            @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                {{--<div class="form-group">
                                    <select class="btn border-primary col-md-12 dropdown-toggle text-center" name="congregation">
                                        <option>Выберите собрание</option>
                                        @foreach($congregations as $congregation)
                                            <option  value="{{ $congregation->id }}">{{ $congregation->name }}</option>
                                        @endforeach
                                    </select>
                                </div>--}}
                                <button class="btn btn-rounded btn-primary btn-block mt-2" type="submit">Зарегистрироваться</button>
                                <p class="text-center">Уже есть аккаунт <a href="{{ route('login') }}">Войдите</a></p>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
