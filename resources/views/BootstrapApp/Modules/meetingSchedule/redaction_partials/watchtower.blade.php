<div class="card mb-5">
    <div class="card-header">
        <h4 class="pb-1 mb-1 d-flex align-items-center" style="color: #2B3F60">
            <div class="icon-square d-flex align-items-center justify-content-center fs-4 flex-shrink-0 me-3 p-2 rounded-2" style="background-color: #2B3F60; width: 1.5em; height: 1.5em;">
                <img class="rounded-2" src="{{ asset('images/watchtower_icon.svg') }}" style="width: 1.5em; height: 1.5em;">
            </div>
            ИЗУЧЕНИЕ СТАТЬИ ИЗ СТОРОЖЕВОЙ БАШНИ
        </h4>
    </div>
    <div class="card-body">
        <form action="{{ route('meetingSchedules.save_watchtower', $ms->id) }}" method="post">
            @csrf
            <div id="watchtower-container">
                @foreach($watchtower as $key => $tower)
                    <div class="row mb-2 d-flex justify-content-between align-items-end border p-1" data-key="{{ $key }}">
                        <div class="col-md-3">
                            <div class="form">
                                <label for="watchtower{{ $key }}">Название:</label>
                                <input type="text" name="watchtower[{{ $key }}][name]" id="watchtower{{ $key }}" class="form-control" value="{{ $tower['name'] }}" required>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form">
                                <label for="watchtower_value_{{ $key }}">Ведущий</label>
                                <select name="watchtower_value_[{{ $key }}][value]" id="watchtower_value_{{ $key }}" class="form-control" required>
                                    <option value="" selected disabled>- Выберите пользователя -</option>
                                    @foreach ($users as $user)
                                        <option value="{{ $user['id'] }}" @if(isset($tower['value']) && $user['id'] == $tower['value']) selected @endif>
                                            {{ $user['last_name'] }} {{ $user['first_name'] }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form">
                                <label for="watchtower_value_{{ $key }}">Помошник</label>
                                <select name="watchtower[{{ $key }}][value_2]" id="watchtower_value_2_{{ $key }}" class="form-control">
                                    <option value="" selected disabled>- Выберите пользователя -</option>
                                    @foreach ($users as $user)ч
                                    <option value="{{ $user['id'] }}" @if(isset($tower['value_2']) && $user['id'] == $tower['value_2']) selected @endif>
                                        {{ $user['last_name'] }} {{ $user['first_name'] }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
{{--                        <div class="col-md-4">--}}
{{--                            <div class="form">--}}
{{--                                <label for="watchtower{{ $key }}">Название:</label>--}}
{{--                                <input type="text" name="watchtower[{{ $key }}][name]" id="tower_value_{{ $key }}" class="form-control" value="{{ $tower['name'] }}" required readonly>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <div class="col-md-4">--}}
{{--                            <div class="form">--}}
{{--                                <label for="tower_value_{{ $key }}">Ведущий</label>--}}
{{--                                <select name="watchtower[{{ $key }}][value]" id="tower_value_{{ $key }}" class="form-control" required>--}}
{{--                                    <option value="" selected disabled>- Выберите пользователя -</option>--}}
{{--                                    @foreach ($users as $user)--}}
{{--                                        <option value="{{ $user['id'] }}" @if(isset($tower['value']) && $user['id'] == $tower['value']) selected @endif>--}}
{{--                                            {{ $user['last_name'] }} {{ $user['first_name'] }}--}}
{{--                                        </option>--}}
{{--                                    @endforeach--}}
{{--                                </select>--}}
{{--                            </div>--}}
{{--                        </div>--}}
                        <div class="col-md-4">
{{--                            <button type="button" class="col btn btn-outline-danger" onclick="removeWatchtower(this)">Удалить</button>--}}
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="row">
                <div class="col-6">
{{--                    <button type="button" class="col btn btn-success" onclick="addWatchtower()">Добавить</button>--}}
                </div>
                <div class="col-6">
                    <button type="submit" class="col btn btn-primary">Сохранить</button>
                </div>
            </div>
        </form>
    </div>
</div>

<script>
    let nextWatchtowerKey = {{ count($watchtower) }};

    function addWatchtower() {
        nextWatchtowerKey++;
        const container = document.getElementById('watchtower-container');
        const newRow = document.createElement('div');
        newRow.className = 'row mb-2 align-items-end border p-1';
        newRow.setAttribute('data-key', nextWatchtowerKey);
        newRow.innerHTML = `
            <div class="col-md-4">
                <div class="form">
                <label for="tower_name_${nextWatchtowerKey}">Название:</label>
                    <input type="text" name="watchtower[${nextWatchtowerKey}][name]" id="tower_name_${nextWatchtowerKey}" class="form-control" required>
                </div>
            </div>
            <div class="col-md-4">
                <label for="tower_value_${nextFieldMinistryKey}">
                    Ответственный
                </label>
                <select name="tower_value_[${nextFieldMinistryKey}][value]" id="tower_value_${nextFieldMinistryKey}" class="form-control" required>
                    <option value="" selected disabled>- Выберите пользователя -</option>
                    @foreach ($users as $user)
        <option value="{{ $user['id'] }}">
                            {{ $user['last_name'] }} {{ $user['first_name'] }}
        </option>
@endforeach
        </select>
    </div>
            </div>

            <div class="col-md-4">
                <button type="button" class="col btn btn-outline-danger" onclick="removeWatchtower(this)">Удалить</button>
            </div>
        `;
        container.appendChild(newRow);
    }

    function removeWatchtower(button) {
        const container = document.getElementById('watchtower-container');
        const rowToRemove = button.closest('.row');
        container.removeChild(rowToRemove);
    }
</script>

<script>
    $(document).ready(function() {
        // Инициализация Select2 для существующих элементов при загрузке страницы
        $('[id^="watchtower_value_"]').each(function() {
            $(this).select2({
                placeholder: 'Введите имя пользователя',
                allowClear: true,
                tags: true,
            });
        });
    });
</script>

<script>
    $(document).ready(function() {
        // Инициализация Select2 для существующих элементов при загрузке страницы
        $('[id^="watchtower_value_"]').each(function() {
            $(this).select2({
                placeholder: 'Введите имя пользователя',
                allowClear: true,
                tags: true,
            });
        });
    });
</script>
