<div class="card-header">
    <h2 class="card-title h4">Основная информация</h2>
</div>

<!-- Body -->
<div class="card-body">
    <!-- Form -->
    <form method="post" action="{{ route('profile.basicInfoSave') }}">
        @csrf
        <!-- Form -->
        <div class="row mb-4">
            <label for="firstNameLabel" class="col-sm-3 col-form-label form-label">Имя и фамилия
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
        <div class="row mb-4">
            <label for="inputGroupMergeGenderSelect" class="col-sm-3 col-form-label form-label">Пол</label>
            <div class="col-sm-9">
                <div class="input-group input-group-sm-vertical">
                    <div class="input-group input-group-merge">
                        <div class="input-group-prepend input-group-text">
                            <i class="bi-person"></i>
                        </div>
                        <select id="inputGroupMergeGenderSelect" name="inputGroupMergeGenderSelect" class="form-select">
                            <option>Выберите пол</option>
                            <option value="male" {{ $gender === 'male' ? 'selected' : '' }}>Мужской</option>
                            <option value="female" {{ $gender === 'female' ? 'selected' : '' }}>Женский</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>



        {{--        <div class="row mb-4">--}}
{{--            <label for="organizationLabel" class="col-sm-3 col-form-label form-label">Собрание</label>--}}

{{--            <div class="col-sm-9">--}}
{{--                <input type="text" class="form-control" name="department" id="departmentLabel" placeholder="{{ $user->congregation->name }}" aria-label="Your department" readonly>--}}
{{--            </div>--}}
{{--        </div>--}}

{{--        <!-- Form -->--}}
{{--        <div class="row align-items-center mb-4">--}}
{{--            <label class="col-sm-3 col-form-label form-label">Статус аккаунта <span class="badge bg-primary text-uppercase ms-1">Личный</span></label>--}}
{{--        </div>--}}
{{--        <!-- End Form -->--}}

        <div class="d-flex justify-content-end">
            <button type="submit" class="btn btn-primary">Сохранить настройки</button>
        </div>
    </form>
</div>
