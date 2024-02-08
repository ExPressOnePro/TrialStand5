
<div class="card">
        <div class="card-header">
            <h3>Службы ответственных</h3>
        </div>
        <div class="card-body">
            <form action="{{route('meetingSchedules.save_responsibles',$ms->id )}}" method="post">
                @csrf
                <div id="responsibles-container">
                    @if (!is_null($responsibles))
                        @foreach($responsibles as $key => $responsible)
                        <div class="row mb-2 d-flex justify-content-between align-items-end border p-1" data-key="{{ $key }}">

                            <div class="col-md-4">
                                <div class="form">
                                    <label for="name_{{ $key }}">Название:</label>
                                    <input type="text" name="responsibles[{{ $key }}][name]" id="name_{{ $key }}" class="form-control" value="{{ $responsible['name'] }}" required>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <label for="responsibles_value_{{ $key }}">Ответственный</label>
                                <select name="responsibles[{{ $key }}][value]" id="responsibles_value_{{ $key }}" class="form-control" required>
                                    <option value="" selected disabled>- Выберите пользователя -</option>
                                    @foreach ($users as $user)
                                        <option value="{{ $user['id'] }}" @if($user['id'] == $responsible['value']) selected @endif>
                                            {{ $user['last_name'] }} {{ $user['first_name'] }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-4 mt-3">
                                <button type="button" class="col btn btn-outline-danger" onclick="removeResponsible({{ $key }})">Удалить</button>
                            </div>
                        </div>
                        @endforeach
                    @endif
                </div>
                <div class="row">
                    <div class="col-6">
                        <button type="button" class="col btn btn-success" onclick="addResponsible()">Добавить</button>
                    </div>
                    <div class="col-6">
                        <button type="submit" class="col btn btn-primary">Сохранить</button>
                    </div>
                </div>
            </form>
        </div>
    </div>


<script>
    let nextKey = {{ is_array($responsibles) ? count($responsibles) : 0 }};

    function addResponsible() {
        nextKey++;
        const container = document.getElementById('responsibles-container');
        const newRow = document.createElement('div');
        newRow.className = 'row mb-2 align-items-end border p-1';
        newRow.setAttribute('data-key', nextKey);
        newRow.innerHTML = `
            <div class="col-md-4">
                <div class="form">
                    <label for="name_${nextKey}">Название:</label>
                    <input type="text" name="responsibles[${nextKey}][name]" id="name_${nextKey}" class="form-control" required>
                </div>
            </div>
            <div class="col-md-4">
                <label for="responsibles_value_${nextKey}">
                    Ответственный
                </label>
                <select name="responsibles[${nextKey}][value]" id="responsibles_value_${nextKey}" class="form-control" required>
                    <option value="" selected disabled>- Выберите пользователя -</option>
                    @foreach ($users as $user)
        <option value="{{ $user['id'] }}">
                            {{ $user['last_name'] }} {{ $user['first_name'] }}
        </option>
@endforeach
        </select>
    </div>

            <div class="col-md-4 mt-3">
                <button type="button" class="col btn btn-outline-danger" onclick="removeResponsible(${nextKey})">Удалить</button>
            </div>
        `;
        container.appendChild(newRow);
    }

    function removeResponsible(key) {
        const container = document.getElementById('responsibles-container');
        const rowToRemove = document.querySelector(`[data-key="${key}"]`);
        container.removeChild(rowToRemove);
    }
</script>
<script>
    $(document).ready(function() {
        @if(isset($key))
        $('#responsibles_value_{{ $key }}').select2({
            placeholder: 'Введите имя пользователя',
            allowClear: true,
            tags: true,
        });
        @endif
    });
</script>
<script>
    $(document).ready(function() {
        // Инициализация Select2 для существующих элементов при загрузке страницы
        $('[id^="responsibles_value_"]').each(function() {
            $(this).select2({
                placeholder: 'Введите имя пользователя',
                allowClear: true,
                tags: true,
            });
        });
    });
</script>

