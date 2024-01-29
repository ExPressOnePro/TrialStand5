
<div class="card">
    <div class="card-header">
        <h4 class="pb-1 d-flex align-items-center" style="color: #D68F00">
            <div class="icon-square d-flex align-items-center justify-content-center fs-4 flex-shrink-0 me-3 p-2 rounded-2" style="background-color: #D68F00; width: 1.5em; height: 1.5em;">
                <img class="rounded-2" src="{{ asset('front/img/wheat.svg') }}" style="width: 1.5em; height: 1.5em;">
            </div>
            ОТТАЧИВАЕМ НАВЫКИ СЛУЖЕНИЯ
        </h4>
    </div>
    <div class="card-body">
        <form action="{{ route('meetingSchedules.save_field_ministry', $ms->id) }}" method="post">
            @csrf
            <div id="field-ministry-container">
                @foreach($fieldMinistry as $key => $fieldMinistryItem)
                    <div class="row mb-2 d-flex justify-content-between align-items-end border p-1" data-key="{{ $key }}">
                        <div class="col-md-3">
                            <div class="form">
                                <label for="field_ministry_name_{{ $key }}">Название:</label>
                                <input type="text" name="field_ministry[{{ $key }}][name]" id="field_ministry_name_{{ $key }}" class="form-control" value="{{ $fieldMinistryItem['name'] }}" required>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form">
                                <label for="field_ministry_value_{{ $key }}">Ведущий</label>
                                <select name="field_ministry[{{ $key }}][value]" id="field_ministry_value_{{ $key }}" class="form-control" required>
                                    <option value="" selected disabled>- Выберите пользователя -</option>
                                    @foreach ($users as $user)
                                        <option value="{{ $user['id'] }}" @if(isset($fieldMinistryItem['value']) && $user['id'] == $fieldMinistryItem['value']) selected @endif>
                                            {{ $user['last_name'] }} {{ $user['first_name'] }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form">
                                <label for="field_ministry_value_{{ $key }}">Ведущий</label>
                                <select name="field_ministry[{{ $key }}][value_2]" id="field_ministry_value_2_{{ $key }}" class="form-control" required>
                                    <option value="" selected disabled>- Выберите пользователя -</option>
                                    @foreach ($users as $user)
                                        <option value="{{ $user['id'] }}" @if(isset($fieldMinistryItem['value_2']) && $user['id'] == $fieldMinistryItem['value_2']) selected @endif>
                                            {{ $user['last_name'] }} {{ $user['first_name'] }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <button type="button" class="col btn btn-outline-danger" onclick="removeFieldMinistry(this)">Удалить</button>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="row">
                <div class="col-6">
                    <button type="button" class="col btn btn-success" onclick="addFieldMinistry()">Добавить</button>
                </div>
                <div class="col-6">
                    <button type="submit" class="col btn btn-primary">Сохранить</button>
                </div>
            </div>
        </form>
    </div>
</div>


    <script>
        let nextFieldMinistryKey = {{ count($fieldMinistry) }};

        function addFieldMinistry() {
            nextFieldMinistryKey++;
            const container = document.getElementById('field-ministry-container');
            const newRow = document.createElement('div');
            newRow.className = 'row mb-2 align-items-end border p-1';
            newRow.setAttribute('data-key', nextFieldMinistryKey);
            newRow.innerHTML = `
            <div class="col-md-3">
                <div class="form">
                    <label for="field_ministry_name_${nextFieldMinistryKey}">Название:</label>
                    <input type="text" name="field_ministry[${nextFieldMinistryKey}][name]" id="field_ministry_name_${nextFieldMinistryKey}" class="form-control" required>
                </div>
            </div>
            <div class="col-md-3">
                <label for="treasure_value_${nextFieldMinistryKey}">
                    Ответственный
                </label>
                <select name="field_ministry[${nextFieldMinistryKey}][value]" id="field_ministry_value_${nextFieldMinistryKey}" class="form-control" required>
                    <option value="" selected disabled>- Выберите пользователя -</option>
                    @foreach ($users as $user)
            <option value="{{ $user['id'] }}">
                            {{ $user['last_name'] }} {{ $user['first_name'] }}
            </option>
@endforeach
            </select>
        </div>
                </div>
                <div class="col-md-3">
                <label for="field_ministry_value_2_${nextFieldMinistryKey}">
                    Ответственный
                </label>
                <select name="field_ministry[${nextFieldMinistryKey}][value_2]" id="field_ministry_value_2_${nextFieldMinistryKey}" class="form-control" required>
                    <option value="" selected disabled>- Выберите пользователя -</option>
                    @foreach ($users as $user)
            <option value="{{ $user['id'] }}">
                            {{ $user['last_name'] }} {{ $user['first_name'] }}
            </option>
@endforeach
            </select>
        </div>
                </div>
                </div>
                <div class="col-md-3">
                    <button type="button" class="col btn btn-outline-danger" onclick="removeFieldMinistry(this)">Удалить</button>
                </div>
`;
            container.appendChild(newRow);
        }

        function removeFieldMinistry(button) {
            const container = document.getElementById('field-ministry-container');
            const rowToRemove = button.closest('.row');
            container.removeChild(rowToRemove);
        }
    </script>
<script>
    $(document).ready(function() {
        // Инициализация Select2 для существующих элементов при загрузке страницы
        $('[id^="field_ministry_value_"]').each(function() {
            $(this).select2({
                placeholder: 'Введите имя пользователя',
                allowClear: true,
                tags: true,
            });
        });
    });
</script>
