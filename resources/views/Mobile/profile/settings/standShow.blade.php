<div class="card-header">
    <h2 class="card-title h4">Отображение таблиц стенда</h2>
</div>

<!-- Body -->
<div class="card-body">
    <!-- Form -->
    <form method="post" action="{{ route('profile.standShowSave') }}">
        @csrf
        <!-- Form -->
        <div class="row mb-4">
            <div class="col-sm-9">
                <h5>Выбирите параметр в каком виде вы хотите чтобы отображались таблицы стенда</h5>
            </div>
        </div>
        <!-- Checkbox Switch -->
        <div class="form-check form-switch mb-4">
            <label class="form-check-label" for="standShow">Все на одной странице?</label>
            <input type="checkbox" class="form-check-input" id="standShow" name="standShow" {{ isset($userInfo['stand_settings']) && $userInfo['stand_settings'] == 1 ? 'checked' : '' }}>

        </div>
        <!-- End Checkbox Switch -->

        <div class="d-flex justify-content-end">
            <button type="submit" class="btn btn-primary">Сохранить настройки</button>
        </div>
    </form>



</div>
