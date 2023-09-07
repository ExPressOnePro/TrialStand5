<form method="POST" action="{{ route('registerCongregation') }}">
    @csrf
    <div class="text-center">
        <div class="mb-5">
            <h1 class="display-5">Создайте ваш аккаунт и новое собрание</h1>
            <p>Уже имеете аккаунт? <a href="{{ route('auth.login') }}">Войти</a></p>
        </div>
        <span class="divider-center text-muted mb-4">ИЛИ</span>
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
        <label class="form-label" for="signupSrPassword">Пароль</label>

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

    <div class="mb-4">
        <label class="form-label" for="congregationName">Название собрания</label>
        <input type="text" class="form-control form-control-lg @error('login') is-invalid @enderror" name="congregationName" id="congregationName"
               placeholder="Введите название собрания" required>
        <span class="invalid-feedback">Пожалуйста введите название собрания</span>
        @error('congregationName')
        <div class="alert alert-card alert-danger"> Название собрания не заполнено</div>
        @enderror
    </div>



    <div class="d-grid gap-2">
        <button type="submit" class="btn btn-primary btn-lg">Создать аккаунт</button>
    </div>
</form>
