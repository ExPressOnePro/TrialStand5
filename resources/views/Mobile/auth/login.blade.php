@extends('Mobile.layouts.front.auth')
@section('title') Meeper | Авторизация @endsection
@section('content')

    <div class="container-fluid px-3">
        @include('Mobile.includes.alerts.alerts')
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
                            <div class="d-flex justify-content-between align-items-center">

                            </div>

                            <div class="input-group input-group-merge mb-4" data-hs-validation-validate-class>
                                <input type="password" class="js-toggle-password form-control form-control-lg" name="passw" id="signupSimpleLoginPassword" placeholder="Введите ваш пароль" aria-label="" required minlength="6"
                                       data-hs-toggle-password-options='{
         "target": "#changePassTarget",
         "defaultClass": "fa-regular fa-eye-slash",
         "showClass": "fa-regular fa-eye",
         "classChangeTarget": "#changePassIcon"
       }'>
                                <a id="changePassTarget" class="input-group-append input-group-text" href="javascript:;">
                                    <i id="changePassIcon" class="fa-regular fa-eye"></i>
                                </a>
                            </div>

                            <span class="invalid-feedback">Пожалалуйста введите верный пароль</span>


                            <div class="form-group">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember">
                                    <label class="form-check-label" for="remember">
                                        {{ __('Запомнить меня') }}
                                    </label>
                                </div>
                            </div>
                            <div class="d-grid">
                                <button type="submit" class="btn btn-rounded btn-primary btn-block mt-2">{{ __('text.Enter') }}</button>
                            </div>
                    </form>
                    <div class="d-grid mt-9">
                        <p> Не имеете аккаунта? </p>
                        <a class="btn btn-outline-primary btn-sm btn-block" href="{{ route('showRegistrationForm') }}"> Зарегистрироваться</a>
                    </div>

                </div>
            </div>
        </div>
    </div>

{{--    <script>--}}
{{--        document.getElementById('show-password').addEventListener('click', () => {--}}
{{--            const passwordInput = document.getElementById('passw');--}}

{{--            if (passwordInput.getAttribute('type') === 'password') {--}}
{{--                passwordInput.setAttribute('type', 'text');--}}
{{--            } else {--}}
{{--                passwordInput.setAttribute('type', 'password');--}}
{{--            }--}}
{{--        });--}}
{{--    </script>--}}
    <script>
        (function() {
            // INITIALIZATION OF TOGGLE PASSWORD
            // =======================================================
            new HSTogglePassword('.js-toggle-password')
        })();
    </script>

@endsection
