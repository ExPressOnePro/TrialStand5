@extends('layouts.auth')
@section('title') Meeper | Авторизация @endsection
@section('content')

        <div class="dropdown-toggle dropleft text-right mt-4 mr-4">
            <i class="fa-solid fa-language text-30" id="dropdownMenuButton" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></i>
            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                @foreach (Config::get('languages') as $lang => $language)
                    @if ($lang != App::getLocale())
                        <a class="dropdown-item" href="{{ route('lang.switch', $lang) }}"> {{$language}}</a>
                    @endif
                @endforeach
            </div>
        </div>
        <div class="main-content-wrap mobile-menu-content">
        <div>
            <div class="auth-logo text-center mb-4"><img src="../../dist-assets/images/logo.png" alt=""></div>
            <h1 class="mb-3 text-36 text-center">{{ __('text.signin') }}</h1>

            <form method="POST" action="{{ route('login') }}">
                @csrf
                <div class="form-group">
                    <label for="login">{{ __('text.Email or Login') }}</label>
                    <input id="login" type="login" name="login" class="form-control form-control-rounded @error('login') is-invalid @enderror"  value="{{ old('login') }}" required autocomplete="email" autofocus>
                    <div class="col-md-6">
                        @error('login')
                        <div class="alert alert-card alert-danger">Логин или Email введен неверно!</div>
                        @enderror
                    </div>
                </div>
                <div class="form-group">
                    <label for="password">{{ __('Пароль') }}</label>
                    <div class="input-group mb-3">
                        <input id="password" type="password" class="form-control form-control-rounded @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" aria-describedby="basic-addon1">
                        <div class="input-group-append"><span class="input-group-text" id="basic-addon1"><i class="fa-regular fa-eye-slash" id="show-password"></i></span></div>
                    </div>
                    <div class="col-md-6">
                        @error('password')
                        <div class="alert alert-card alert-danger">{{ __('text.password incorrect') }}</div>
                        @enderror
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <button type="submit" class="btn btn-rounded btn-primary btn-block mt-2">{{ __('text.Enter') }}</button>

                        @if (Route::has('password.request'))
                            <a class="btn btn-link" href="{{ route('password.request') }}">
                                {{ __('text.Forgot your password?') }}
                            </a>
                        @endif
                    </div>
                </div>
            </form>
            <a href="{{ '/registration' }}">
                <button class="btn btn-rounded btn-primary btn-block mt-2">
                    {{ __('text.Registration') }}
                </button>
            </a>
        </div>

        </div>
    <script>
        document.getElementById('show-password').addEventListener('click', () => {
            const passwordInput = document.getElementById('password');

            if (passwordInput.getAttribute('type') === 'password') {
                passwordInput.setAttribute('type', 'text');
            } else {
                passwordInput.setAttribute('type', 'password');
            }
        });
    </script>

@endsection
