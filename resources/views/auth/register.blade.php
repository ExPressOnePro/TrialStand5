@extends('layouts.auth')
@section('title') Meeper | Регистрация @endsection
@section('content')

    @inject('mobile_detect', 'Mobile_Detect')
    @if ($mobile_detect->isMobile())
        <div class="auth-logo text-center mb-4"><img src="../../dist-assets/images/logo.png" alt=""></div>
        <h1 class="mb-3 text-36 text-center">Регистрация</h1>
        <p class="heading mb-30 text-center">Создайте новый аккаунт чтобы пользоваться возможностями Meeper</p>
        <form method="POST" action="{{ route('register') }}">
            @csrf
            <div class="form-row">
                <div class="form-group col-md-12">
                    <input class="form-control form-control-rounded @error('email') is-invalid @enderror"  name="email" placeholder="Эл. адрес ( ваша почта )" type="email">
                    <div class="col-md-6">
                        @error('email')
                        <div class="alert alert-card alert-danger">Email не заполнен или занят</div>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-12">
                    <input class="form-control form-control-rounded @error('name') is-invalid @enderror" name="name" placeholder="Имя и фамилия ( будут видеть все пользователи )" value="" type="text">
                    <div class="col-md-6">
                        @error('name')
                        <div class="alert alert-card alert-danger">Имя пользователя не заполнено (минимум 5 символов)</div>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-12">
                    <input class="form-control form-control-rounded @error('login') is-invalid @enderror" name="login" placeholder="Логин (можно использовать для входа)" value="" type="text">
                    <div class="col-md-6">
                        @error('login')
                        <div class="alert alert-card alert-danger">Логин пользователя не заполнен или занят</div>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-12">
                    <input class="form-control form-control-rounded @error('password') is-invalid @enderror"  name="password" placeholder="Пароль (минимум 6 символов)" type="password">
                    <div class="col-md-6">
                        @error('password')
                        <div class="alert alert-card alert-danger">Пароль некорректно введен (минимум 6 символов)</div>
                        @enderror
                    </div>
                </div>
            </div>
            <button class="btn btn-rounded btn-primary btn-block mt-2" type="submit">Зарегистрироваться</button>
        </form>
        <br>
        <p class="text-center">Уже есть аккаунт ? <a href="{{ route('login') }}"> <button class="btn btn-info">Войдите</button></a></p>

    @elseif ($mobile_detect->isTablet())

        <div class="auth-logo text-center mb-4"><img src="../../dist-assets/images/logo.png" alt=""></div>
        <h1 class="mb-3 text-36 text-center">Регистрация</h1>
        <p class="heading mb-30 text-center">Создайте новый аккаунт чтобы пользоваться возможностями Meeper</p>
        <form method="POST" action="{{ route('register') }}">
            @csrf
            <div class="form-row">
                <div class="form-group col-md-12">
                    <input class="form-control form-control-rounded @error('email') is-invalid @enderror"  name="email" placeholder="Эл. адрес ( ваша почта )" type="email">
                    <div class="col-md-6">
                        @error('email')
                        <div class="alert alert-card alert-danger">Email не заполнен или занят</div>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-12">
                    <input class="form-control form-control-rounded @error('name') is-invalid @enderror" name="name" placeholder="Имя и фамилия ( будут видеть все пользователи )" value="" type="text">
                    <div class="col-md-6">
                        @error('name')
                        <div class="alert alert-card alert-danger">Имя пользователя не заполнено (минимум 5 символов)</div>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-12">
                    <input class="form-control form-control-rounded @error('login') is-invalid @enderror" name="login" placeholder="Логин (можно использовать для входа)" value="" type="text">
                    <div class="col-md-6">
                        @error('login')
                        <div class="alert alert-card alert-danger">Логин пользователя не заполнен или занят</div>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-12">
                    <input class="form-control form-control-rounded @error('password') is-invalid @enderror"  name="password" placeholder="Пароль (минимум 6 символов)" type="password">
                    <div class="col-md-6">
                        @error('password')
                        <div class="alert alert-card alert-danger">Пароль некорректно введен (минимум 6 символов)</div>
                        @enderror
                    </div>
                </div>
            </div>
            <button class="btn btn-rounded btn-primary btn-block mt-2" type="submit">Зарегистрироваться</button>
        </form>
        <br>
        <p class="text-center">Уже есть аккаунт ? <a href="{{ route('login') }}"> <button class="btn btn-info">Войдите</button></a></p>

    @else
        <div class="auth-layout-wrap" style="background-image: url(../../dist-assets/images/log2.jpg)">
            <div class="auth-content">
                <div class="card o-hidden align-items-center">
                    <div class="row">
                        <div class="col">
                            <div class="p-4">
                                <div class="auth-logo text-center mb-4"><img src="../../dist-assets/images/logo.png" alt=""></div>
                                <h1 class="mb-3 text-36 text-center">Регистрация</h1>
                                <p class="mb-30 text-center">Создайте новый аккаунт чтобы пользоваться возможностями Meeper</p>
                                <form method="POST" action="{{ route('register') }}">
                                    @csrf
                                    <div class="form-row">
                                        <div class="form-group col-md-12">
                                            <input class="form-control form-control-rounded @error('email') is-invalid @enderror"  name="email" placeholder="Эл. адрес" type="email">
                                            <div class="col-md-6">
                                                @error('email')
                                                    <div class="alert alert-card alert-danger">Email не заполнен или занят</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md-12">
                                            <input class="form-control form-control-rounded @error('name') is-invalid @enderror" name="name" placeholder="Имя и фамилия" value="" type="text">
                                            <div class="col-md-6">
                                                @error('name')
                                                <div class="alert alert-card alert-danger">Имя пользователя не заполнено (минимум 5 символов)</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md-12">
                                            <input class="form-control form-control-rounded @error('login') is-invalid @enderror" name="login" placeholder="Логин (Имя пользователя)" value="" type="text">
                                            <div class="col-md-6">
                                                @error('login')
                                                <div class="alert alert-card alert-danger">Логин пользователя не заполнен или занят</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md-12">
                                            <input class="form-control form-control-rounded @error('password') is-invalid @enderror"  name="password" placeholder="Password" type="password">
                                            <div class="col-md-6">
                                                @error('password')
                                                <div class="alert alert-card alert-danger">Пароль некорректно введен (минимум 6 символов)</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <button class="btn btn-rounded btn-primary btn-block mt-2" type="submit">Зарегистрироваться</button>
                                </form>
                                <br>
                                <p class="text-center">Уже есть аккаунт ? <a href="{{ route('login') }}"> <button class="btn btn-info">Войдите</button></a></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif

    {{--<div class="auth-layout-wrap" style="background-image: url(../../dist-assets/images/log2.jpg)">
    <div class="auth-content">
        <div class="card o-hidden align-items-center">
            <div class="row">
                <div class="col">
                    <div class="p-4">
                        <div class="auth-logo text-center mb-4"><img src="../../dist-assets/images/logo.png" alt=""></div>
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
                                        <input class="form-control form-control-rounded @error('login') is-invalid @enderror" name="login" placeholder="Логин (Имя пользователя)" value="" type="text">
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
                                <button class="btn btn-rounded btn-primary btn-block mt-2" type="submit">Зарегистрироваться</button>
                                <p class="text-center">Уже есть аккаунт <a href="{{ route('login') }}">Войдите</a></p>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>--}}

@endsection
