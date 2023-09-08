@extends('Mobile.layouts.front.auth')
@section('title') Meeper | Авторизация @endsection
@section('content')

    <div class="container-fluid px-3">
        <div class="row">
            <div class="col-lg-6 d-flex justify-content-center align-items-center min-vh-lg-100">
                <div class="w-100 content-space-t-2 content-space-t-lg-2 content-space-b-1" style="max-width: 25rem;">

                        <div class="text-center">
                            <div class="mb-5">
                                <h1 class="display-5">{{ __('text.signin') }}</h1>
                            </div>
                        </div>
                        <form method="POST" action="{{ route('login') }}">
                            @csrf

                            <div class="mb-4">
                                <input id="login" type="login" name="login" class="form-control form-control @error('login') is-invalid @enderror"
                                       value="{{ old('login') }}" placeholder="{{ __('text.Email or Login') }}" required autocomplete="email">
                                <div class="col-md-6">
                                    @error('login')
                                    <div class="alert alert-card alert-danger">Логин или Email введен неверно!</div>
                                    @enderror
                                </div>
                            </div>


                            <div class="form-group">
                                <div class="input-group mb-3">
                                    <input id="passw" type="passw" class="form-control form-control
                                    @error('password') is-invalid @enderror" name="password" required autocomplete="current-password"
                                           placeholder="{{ __('Пароль') }}" aria-describedby="basic-addon1">
                                    <div class="input-group-append"><span class="input-group-text" id="basic-addon1"><i class="fa-regular fa-eye" id="show-password"></i></span></div>
                                </div>
                                <div class="col-md-6">
                                    @error('password')
                                    <div class="alert alert-card alert-danger">{{ __('text.password incorrect') }}</div>
                                    @enderror
                                </div>
                            </div>

{{--                            <span class="d-flex justify-content-end align-items-center">--}}
{{--                                     @if (Route::has('password.selectLogin'))--}}
{{--                                    <a class="form-label-link mb-0" href="{{ route('password.selectLogin') }}">{{ __('text.Forgot your password?') }}</a>--}}
{{--                                @endif--}}
{{--                            </span>--}}

{{--                            <div class="form-check mb-4">--}}
{{--                                <input class="form-check-input" type="checkbox" value="" id="termsCheckbox">--}}
{{--                                <label class="form-check-label" for="termsCheckbox">--}}
{{--                                    Remember me--}}
{{--                                </label>--}}
{{--                            </div>--}}

                            <div class="d-grid">
                                <button type="submit" class="btn btn-rounded btn-primary btn-block mt-2">{{ __('text.Enter') }}</button>
                            </div>
                    </form>
                    <div class="d-grid mt-9">
                                <p> Не имеете аккаунта? </p>
                                    <a class="btn btn-outline-primary btn-sm btn-block" href="{{ route('auth.registration') }}"> Зарегистрироваться</a>
                    </div>

                </div>
            </div>
        </div>
    </div>

{{--        <div class="dropdown-toggle dropleft text-right mt-4 mr-4">--}}
{{--            <i class="fa-solid fa-language text-30" id="dropdownMenuButton" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></i>--}}
{{--            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">--}}
{{--                @foreach (Config::get('languages') as $lang => $language)--}}
{{--                    @if ($lang != App::getLocale())--}}
{{--                        <a class="dropdown-item" href="{{ route('lang.switch', $lang) }}"> {{$language}}</a>--}}
{{--                    @endif--}}
{{--                @endforeach--}}
{{--            </div>--}}
{{--        </div>--}}
{{--        <div class="main-content-wrap mobile-menu-content">--}}
{{--        <div>--}}
{{--            <div class="auth-logo text-center mb-4"><img src="../../dist-assets/images/logo.png" alt=""></div>--}}
{{--            <h1 class="mb-3 text-36 text-center">{{ __('text.signin') }}</h1>--}}

{{--            <form method="POST" action="{{ route('login') }}">--}}
{{--                @csrf--}}
{{--                <div class="form-group">--}}
{{--                    <label for="login">{{ __('text.Email or Login') }}</label>--}}
{{--                    <input id="login" type="login" name="login" class="form-control form-control-rounded @error('login')
is-invalid @enderror"  value="{{ old('login') }}" required autocomplete="email" autofocus>--}}
{{--                    <div class="col-md-6">--}}
{{--                        @error('login')--}}
{{--                        <div class="alert alert-card alert-danger">Логин или Email введен неверно!</div>--}}
{{--                        @enderror--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <div class="form-group">--}}
{{--                    <label for="password">{{ __('Пароль') }}</label>--}}
{{--                    <div class="input-group mb-3">--}}
{{--                        <input id="password" type="password" class="form-control form-control-rounded @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" aria-describedby="basic-addon1">--}}
{{--                        <div class="input-group-append"><span class="input-group-text" id="basic-addon1"><i class="fa-regular fa-eye-slash" id="show-password"></i></span></div>--}}
{{--                    </div>--}}
{{--                    <div class="col-md-6">--}}
{{--                        @error('password')--}}
{{--                        <div class="alert alert-card alert-danger">{{ __('text.password incorrect') }}</div>--}}
{{--                        @enderror--}}
{{--                    </div>--}}
{{--                </div>--}}

{{--                <div class="row">--}}
{{--                    <div class="col-md-12">--}}
{{--                        <button type="submit" class="btn btn-rounded btn-primary btn-block mt-2">{{ __('text.Enter') }}</button>--}}

{{--                        @if (Route::has('password.request'))--}}
{{--                            <a class="btn btn-link" href="{{ route('password.request') }}">--}}
{{--                                {{ __('text.Forgot your password?') }}--}}
{{--                            </a>--}}
{{--                        @endif--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </form>--}}
{{--            <a href="{{ '/registration' }}">--}}
{{--                <button class="btn btn-rounded btn-primary btn-block mt-2">--}}
{{--                    {{ __('text.Registration') }}--}}
{{--                </button>--}}
{{--            </a>--}}
{{--        </div>--}}

{{--        </div>--}}
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
