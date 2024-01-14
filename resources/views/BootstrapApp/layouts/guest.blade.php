<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" >
@include('BootstrapApp.includes.bootstrap-head')
@isset($user)
    @if(auth()->user()->congregation_id == 1)
        @include('BootstrapApp.includes.bootstrap-header')
    @endif
@endisset
<body class="bg-body-tertiary">
<main class="form-signin w-100 m-auto">
    @yield('login')
    @yield('registration')
    @isset($user)
        @if(auth()->user()->congregation_id == 1)
            @yield('content')
        @endif
    @endisset
</main>

{{--<style>--}}
{{--    html,--}}
{{--    body {--}}
{{--        height: 100%;--}}
{{--    }--}}

{{--    .form-signin {--}}
{{--        max-width: 330px;--}}

{{--    }--}}

{{--    .form-signin .form-floating:focus-within {--}}
{{--        z-index: 2;--}}
{{--    }--}}

{{--    .form-signin input[type="email"] {--}}
{{--        margin-bottom: -1px;--}}
{{--        border-bottom-right-radius: 0;--}}
{{--        border-bottom-left-radius: 0;--}}
{{--    }--}}

{{--    .form-signin input[type="password"] {--}}
{{--        margin-bottom: 10px;--}}
{{--        border-top-left-radius: 0;--}}
{{--        border-top-right-radius: 0;--}}
{{--    }--}}

{{--</style>--}}
{{--<main class="form-signin w-100 m-auto">--}}

{{--    <form id="authorize-user">--}}
{{--        <div class="text-center align-items-center">--}}
{{--            <img class="mb-4" src="{{asset('/android-chrome-512x512.png')}}" alt="" width="128" height="128s">--}}
{{--            <h1 class="h3 mb-3 fw-normal">{{ __('text.signin') }}</h1>--}}
{{--        </div>--}}

{{--        <div class="form-floating mb-2">--}}
{{--            <input type="login" class="form-control rounded-2" name="login" id="login" placeholder="{{ __('text.Email or Login') }}">--}}
{{--            <label for="floatingInput">{{ __('text.Email or Login') }}</label>--}}
{{--        </div>--}}
{{--        <div class="form-floating position-relative">--}}
{{--            <input type="password" class="form-control rounded-2" name="passw" id="passw" placeholder="{{ __('Пароль') }}">--}}
{{--            <label for="floatingPassword">{{ __('Пароль') }}</label>--}}
{{--            <i class="bi bi-eye-slash password-toggle me-2" id="passwordToggle"--}}
{{--               style="position: absolute; top: 50%; right: 10px; transform: translateY(-50%); cursor: pointer;">--}}
{{--            </i>--}}
{{--        </div>--}}

{{--        <div class="form-check text-start my-3">--}}
{{--            <input class="form-check-input" type="checkbox" value="remember-me" name="remember" id="remember">--}}
{{--            <label class="form-check-label" for="flexCheckDefault">--}}
{{--                {{ __('Запомнить меня') }}--}}
{{--            </label>--}}
{{--        </div>--}}
{{--        <button type="submit" class="btn btn-primary w-100 py-2" onclick="authorizeUser(event)">{{ __('text.Enter') }}</button>--}}
{{--    </form>--}}
{{--    <script>--}}
{{--        document.getElementById('passwordToggle').addEventListener('click', function () {--}}
{{--            var passwordInput = document.getElementById('passw');--}}
{{--            var toggleIcon = document.getElementById('passwordToggle');--}}
{{--            if (passwordInput.type === 'password') {--}}
{{--                passwordInput.type = 'text';--}}
{{--                toggleIcon.classList.remove('bi-eye-slash');--}}
{{--                toggleIcon.classList.add('bi-eye');--}}
{{--            } else {--}}
{{--                passwordInput.type = 'password';--}}
{{--                toggleIcon.classList.remove('bi-eye');--}}
{{--                toggleIcon.classList.add('bi-eye-slash');--}}
{{--            }--}}
{{--        });--}}
{{--    </script>--}}
{{--    <script>--}}
{{--        function authorizeUser(event) {--}}
{{--            const formElement = document.getElementById('authorize-user');--}}
{{--            var formData = new FormData(formElement);--}}
{{--            const password =  formElement.passw.value;--}}
{{--            formElement.passw.value = '';--}}
{{--            formData.append('_token', '{{ csrf_token() }}');--}}
{{--            event.preventDefault();--}}
{{--            $.ajax({--}}
{{--                url: '{{ route('login') }}',--}}
{{--                type: 'POST',--}}
{{--                data: formData,--}}
{{--                processData: false,--}}
{{--                contentType: false,--}}
{{--                success: function(response) {--}}
{{--                    if (response.error) {--}}
{{--                        console.log('Server error:', response.error);--}}
{{--                    } else {--}}
{{--                        console.log('Success:', true);--}}
{{--                        window.location.href = "{{ route('home') }}";--}}
{{--                    }--}}
{{--                },--}}
{{--                error: function(xhr) {--}}
{{--                    var errors = xhr.responseJSON.errors;--}}

{{--                    $(".form-error").remove();--}}

{{--                    for(error in errors) {--}}
{{--                        // Put back the form password item--}}
{{--                        formElement.passw.value = password;--}}

{{--                        var input = $('input[name=' + error + ']');--}}
{{--                        input.parent('.form-floating').after('<span class="form-error text-danger">' + errors[error][0] + '</span>');--}}
{{--                    }--}}
{{--                }--}}
{{--            });--}}
{{--        }--}}
{{--    </script>--}}
{{--</main>--}}

{{--<main class="form-signin w-100 m-auto">--}}

{{--    <div id="preloader" class="text-center" style="display: none;">--}}
{{--        <div class="spinner-border" style="width: 3rem; height: 3rem;" role="status">--}}
{{--            <span class="sr-only">...</span>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--    <div id="dynamic-content-showLoginForm"></div>--}}
{{--    <script>--}}
{{--        $(document).ready(function () {--}}
{{--            loadDynamicContent('menu');--}}
{{--        });--}}

{{--        function loadDynamicContent(page) {--}}
{{--            $('#preloader').show();--}}
{{--            $.ajax({--}}
{{--                url: "{{ route('showLoginForm') }}",--}}
{{--                type: "GET",--}}
{{--                success: function (data) {--}}
{{--                    $('#preloader').hide();--}}
{{--                    $('#dynamic-content-showLoginForm').html(data);--}}
{{--                },--}}
{{--                error: function (error) {--}}
{{--                    $('#preloader').hide();--}}
{{--                    console.error(error);--}}
{{--                }--}}
{{--            });--}}
{{--        }--}}
{{--    </script>--}}
{{--</main>--}}
</body>
</html>

