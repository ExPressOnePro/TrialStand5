@extends('Mobile.layouts.front.auth')
@section('title') Meeper | Регистрация @endsection
@section('content')

    <div class="container-fluid px-3">
        <div class="row">
            <div class="col-lg-6 d-flex justify-content-center align-items-center min-vh-lg-100">
                <div class="w-100 content-space-t-4 content-space-t-lg-2 content-space-b-1" style="max-width: 25rem;">
                    <!-- Form -->
                    <form method="POST" action="{{ route('register') }}">
                        @csrf
                        <div class="text-center">
                            <div class="mb-5">
                                <h1 class="display-5">Создайте ваш аккаунт</h1>
                                <p>Уже имеете аккаунт? <a class="link" href="{{ route('auth.login') }}">Войти</a></p>
                            </div>
                            <span class="divider-center text-muted mb-4">OR</span>
                        </div>

                        <label class="form-label" for="fullNameSrEmail">Полное имя</label>


                        <div class="row">
                            <div class="col-sm-6">
                                <div class="mb-4">
                                    <input type="text" class="form-control form-control-lg @error('first_name') is-invalid @enderror"
                                           name="first_name" id="fullNameSrEmail" placeholder="Ваше имя" aria-label="Ваше имя" required>
                                    <span class="invalid-feedback">Please enter your first name.</span>
                                    @error('first_name')
                                        <div class="alert alert-danger">Имя пользователя не заполнено</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="mb-4">
                                    <input type="text" class="form-control form-control-lg @error('last_name') is-invalid @enderror"
                                           name="last_name" id="fullNameSrEmail" placeholder="Ваша фамилия" aria-label="Ваша фамилия" required>
                                    <span class="invalid-feedback">Please enter your last name.</span>
                                    @error('last_name')
                                        <div class="alert alert-danger">Фамилия пользователя не заполнена</div>
                                    @enderror
                                </div>
                            </div>
                        </div>


                        <!-- Form -->
                        <div class="mb-4">
                            <label class="form-label" for="signupSrEmail">Ваша почта</label>
                            <input type="email" class="form-control form-control-lg @error('email') is-invalid @enderror"
                                   name="email" id="signupSrEmail" placeholder="Эл. адрес ( ваша почта )" aria-label="Эл. адрес ( ваша почта )" required>
                            <span class="invalid-feedback">Please enter a valid email address.</span>
                            @error('email')
                            <div class="alert alert-card alert-danger">Email не заполнен или занят</div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label class="form-label" for="signupSrEmail">Ваш Логин</label>
                            <input type="text" class="form-control form-control-lg @error('login') is-invalid @enderror" name="login" id="signupSrEmail"
                                   placeholder="Логин (можно использовать для входа)" aria-label="Логин (можно использовать для входа)" required>
                            <span class="invalid-feedback">Please enter a valid email address.</span>
                            @error('login')
                            <div class="alert alert-card alert-danger">Логин пользователя не заполнен или занят</div>
                            @enderror
                        </div>

                        <!-- Form -->
                        <div class="mb-4">
                            <label class="form-label" for="signupSrPassword">пароль</label>

                            <div class="input-group mb-3">
                                <input id="password" type="password" class="form-control form-control-rounded @error('password') is-invalid @enderror" name="password" placeholder="Пароль (минимум 6 символов)" required autocomplete="current-password" aria-describedby="basic-addon1">
                                <div class="input-group-append"><span class="input-group-text" id="basic-addon1"><i class="fa-regular fa-eye-slash" id="show-password"></i></span></div>
                            </div>
                            <div class="col-md-6">
                                @error('password')
                                    <div class="alert alert-card alert-danger">Пароль некорректно введен (минимум 6 символов)</div>
                                @enderror
                            </div>
                                                        </div>
                                                        <!-- End Form -->


                                                        <div class="d-grid gap-2">
                                                            <button type="submit" class="btn btn-primary btn-lg">Создать аккаунт</button>
                                                        </div>
                                                    </form>
                                                    <!-- End Form -->
                                                </div>
                                            </div>
                                            <!-- End Col -->
                                        </div>
                                        <!-- End Row -->
                                    </div>



                                                        {{--        <div class="auth-logo text-center mb-4"><img src="../../dist-assets/images/logo.png" alt=""></div>--}}
{{--        <h1 class="mb-3 text-36 text-center">Регистрация</h1>--}}
{{--        <p class="heading mb-30 text-center">Создайте новый аккаунт чтобы пользоваться возможностями Meeper</p>--}}
{{--        <form method="POST" action="{{ route('register') }}">--}}
{{--        @csrf--}}
{{--            <!--Email-->--}}
{{--            <div class="form-row">--}}
{{--                <div class="form-group col-md-12">--}}
{{--                    <input class="form-control form-control-rounded @error('email') is-invalid @enderror"  name="email" placeholder="Эл. адрес ( ваша почта )" type="email">--}}
{{--                    <div class="col-md-6">--}}
{{--                        @error('email')--}}
{{--                        <div class="alert alert-card alert-danger">Email не заполнен или занят</div>--}}
{{--                        @enderror--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--            <!--first_name-->--}}
{{--            <div class="form-row">--}}
{{--                <div class="form-group col-md-12">--}}
{{--                    <input class="form-control form-control-rounded @error('name') is-invalid @enderror" name="first_name" placeholder="Ваше имя ( будут видеть все пользователи )" value="" type="text">--}}
{{--                    <div class="col-md-6">--}}
{{--                        @error('name')--}}
{{--                        <div class="alert alert-card alert-danger">Имя пользователя не заполнено</div>--}}
{{--                        @enderror--}}
{{--                </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--            <!--last_name-->--}}
{{--            <div class="form-row">--}}
{{--                <div class="form-group col-md-12">--}}
{{--                    <input class="form-control form-control-rounded @error('name') is-invalid @enderror" name="last_name" placeholder="Ваша фамилия ( будут видеть все пользователи )" value="" type="text">--}}
{{--                    <div class="col-md-6">--}}
{{--                        @error('name')--}}
{{--                        <div class="alert alert-card alert-danger">Фамилия пользователя не заполнена</div>--}}
{{--                        @enderror--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--            <!--login-->--}}
{{--            <div class="form-row">--}}
{{--                <div class="form-group col-md-12">--}}
{{--                    <input class="form-control form-control-rounded @error('login') is-invalid @enderror" name="login" placeholder="Логин (можно использовать для входа)" value="" type="text">--}}
{{--                    <div class="col-md-6">--}}
{{--                        @error('login')--}}
{{--                        <div class="alert alert-card alert-danger">Логин пользователя не заполнен или занят</div>--}}
{{--                        @enderror--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--            <!--Password-->--}}
{{--            <div class="form-row">--}}
{{--                <div class="form-group col-md-12">--}}
{{--                    <div class="input-group mb-3">--}}
{{--                        <input id="password" type="password" class="form-control form-control-rounded @error('password') is-invalid @enderror" name="password" placeholder="Пароль (минимум 6 символов)" required autocomplete="current-password" aria-describedby="basic-addon1">--}}
{{--                        <div class="input-group-append"><span class="input-group-text" id="basic-addon1"><i class="fa-regular fa-eye-slash" id="show-password"></i></span></div>--}}
{{--                    </div>--}}
{{--                    <div class="col-md-6">--}}
{{--                        @error('password')--}}
{{--                        <div class="alert alert-card alert-danger">Пароль некорректно введен (минимум 6 символов)</div>--}}
{{--                        @enderror--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}

{{--            <button class="btn btn-rounded btn-primary btn-block mt-2" type="submit">Зарегистрироваться</button>--}}
{{--        </form>--}}
{{--        <br>--}}
{{--        <p class="text-center">Уже есть аккаунт ? <a href="{{ route('login') }}"> <button class="btn btn-info">Войдите</button></a></p>--}}



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
