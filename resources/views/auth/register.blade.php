@extends('BootstrapApp.layouts.guest')
@section('title') Meeper @endsection
@section('registration')

    <style>
        html,
        body {
            height: 100%;
        }

        .form-signup {
            max-width: 330px;

        }

        .form-signup .form-floating:focus-within {
            z-index: 2;
        }

        .form-signup input[type="email"] {
            margin-bottom: -1px;
            border-bottom-right-radius: 0;
            border-bottom-left-radius: 0;
        }

        .form-signup input[type="password"] {
            margin-bottom: 10px;
            border-top-left-radius: 0;
            border-top-right-radius: 0;
        }

    </style>
    <main class="form-signup w-100 m-auto mt-5">

        <form id="register-user">
            <div class="text-center align-items-center">
                <img class="mb-4" src="{{asset('/android-chrome-512x512.png')}}" alt="" width="128" height="128s">
                <h1 class="h3 mb-3 text-36 text-center">Создайте ваш аккаунт</h1>
                <h1 class="h6 mb-3 fw-normal">Создайте новый аккаунт чтобы пользоваться возможностями Meeper</h1>
            </div>
            <div class="form-floating mb-2">
                <input type="email" class="form-control rounded-2" name="email" id="email" placeholder="Эл. адрес ( ваша почта )">
                <label for="email">Эл. адрес (ваша почта)</label>
            </div>

            <div class="form-floating mb-2">
                <input type="text" class="form-control rounded-2" id="first_name" name="first_name" placeholder="Ваше имя ( будут видеть все пользователи )">
                <label for="first_name">Имя (видно всем)</label>
            </div>

            <div class="form-floating mb-2">
                <input type="text" class="form-control rounded-2" id="last_name" name="last_name" placeholder="Ваша фамилия ( будут видеть все пользователи )">
                <label for="last_name">Фамилия (видно всем)</label>
            </div>


            <div class="form-floating mb-2">
                <input type="login" class="form-control rounded-2" name="login" id="login" placeholder="{{ __('text.Email or Login') }}">
                <label for="login">{{ __('text.Email or Login') }}</label>
            </div>

            <div class="form-floating position-relative">
                <input type="password" class="form-control rounded-2" name="passw" id="password" placeholder="{{ __('Пароль') }}">
                <label for="passw">{{ __('Пароль') }}</label>
                <i class="bi bi-eye-slash password-toggle me-2" id="passwordToggle"
                   style="position: absolute; top: 50%; right: 10px; transform: translateY(-50%); cursor: pointer;">
                </i>
            </div>

            <div class="form-check text-start my-3">
                <input class="form-check-input" type="checkbox" value="remember-me" name="remember" id="remember">
                <label class="form-check-label" for="remember">
                    {{ __('Запомнить меня') }}
                </label>
            </div>
            <button type="submit" class="btn btn-primary w-100 py-2" onclick="registerUser()">{{ __('text.Registration') }}</button>
        </form>
    </main>
    <script>
        document.getElementById('passwordToggle').addEventListener('click', function () {
            var passwordInput = document.getElementById('password');
            var toggleIcon = document.getElementById('passwordToggle');
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                toggleIcon.classList.remove('bi-eye-slash');
                toggleIcon.classList.add('bi-eye');
            } else {
                passwordInput.type = 'password';
                toggleIcon.classList.remove('bi-eye');
                toggleIcon.classList.add('bi-eye-slash');
            }
        });
    </script>

    <script>
        function registerUser() {
            const formElement = document.getElementById('register-user');
            var formData = new FormData(formElement);
            const password =  formElement.passw.value;
            formElement.passw.value = '';
            formData.append('_token', '{{ csrf_token() }}');
            event.preventDefault();
            $.ajax({
                url: '{{ route('register') }}',
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    if (response.error) {
                        console.log('Server error:', response.error);
                    } else {
                        console.log('Success:', true);
                        location.reload();
                        window.location.href = "{{ route('home') }}";
                    }
                },
                error: function(xhr) {
                    var errors = xhr.responseJSON.errors;

                    $(".form-error").remove();

                    for(error in errors) {
                        // Put back the form password item
                        formElement.passw.value = password;

                        var input = $('input[name=' + error + ']');
                        input.parent('.form-floating').after('<span class="form-error text-danger">' + errors[error][0] + '</span>');
                    }
                }
            });
        }
    </script>
@endsection
