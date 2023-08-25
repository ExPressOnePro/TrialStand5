<div class="card-header">
    <h2 class="card-title h4">Основная информация</h2>
</div>

<!-- Body -->
<div class="card-body">
    <!-- Form -->
    <form>
        <!-- Form -->
        <div class="row mb-4">
            <label for="firstNameLabel" class="col-sm-3 col-form-label form-label">Полное имя
                <i class="bi-question-circle text-body ms-1" data-bs-toggle="tooltip" data-bs-placement="top"
                   aria-label="Будет отображатся в записях и взаимодействиях с другими пользователями" data-bs-original-title="Будет отображатся в записях и взаимодействиях с другими пользователями"></i></label>

            <div class="col-sm-9">
                <div class="input-group input-group-sm-vertical">
                    <input type="text" class="form-control" name="first_name" id="first_name" placeholder="Ваше имя" aria-label="Ваше имя" value="{{ $user->first_name }}">
                    <input type="text" class="form-control" name="last_name" id="last_name" placeholder="Ваша фамилия" aria-label="Ваша фамилия" value="{{ $user->last_name }}">
                </div>
            </div>
        </div>
        <!-- End Form -->

        <!-- Form -->
        <div class="row mb-4">
            <label for="emailLabel" class="col-sm-3 col-form-label form-label">Почтовый адресс (Email)</label>

            <div class="col-sm-9">
                <input type="email" class="form-control" name="email" id="email" placeholder="Email" aria-label="Email" value="{{ $user->email }}">
            </div>
        </div>
        <!-- End Form -->

        @php
            $info = json_decode($user->info, true); // Разбираем строку JSON в ассоциативный массив
        @endphp
        <!-- Form -->
        <div class="row mb-4">
            <label for="phoneLabel" class="col-sm-3 col-form-label form-label">Номер телефона <span class="form-label-secondary">Действующий</span></label>

            <div class="col-sm-9">
                <input type="text" class="js-input-mask form-control" name="mobile_phone" id="mobile_phone" placeholder="+x(xxx)xxx-xx-xx" aria-label="+x(xxx)xxx-xx-xx" value="{{ isset($info['mobile_phone']) ? $info['mobile_phone'] : '' }}" data-hs-mask-options="{
                               &quot;mask&quot;: &quot;+0(000)000-00-00&quot;
                             }">
            </div>
        </div>

        <div class="row mb-4">
            <label for="organizationLabel" class="col-sm-3 col-form-label form-label">Собрание</label>

            <div class="col-sm-9">
                <input type="text" class="form-control" name="department" id="departmentLabel" placeholder="{{ $user->congregation->name }}" aria-label="Your department" readonly>
            </div>
        </div>




{{--        <!-- Form -->--}}
{{--        <div class="row align-items-center mb-4">--}}
{{--            <label class="col-sm-3 col-form-label form-label">Статус аккаунта <span class="badge bg-primary text-uppercase ms-1">Личный</span></label>--}}
{{--        </div>--}}
{{--        <!-- End Form -->--}}

        <div class="d-flex justify-content-end">
            <button type="submit" class="btn btn-primary">Сохранить настройки</button>
        </div>
    </form>
    <!-- End Form -->
</div>
<!-- End Body -->
