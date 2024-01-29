
<div class="card">
        <div class="card-header">
            <h4 class="pb-1 mb-1 d-flex align-items-center" style="color: #2A6B77">
                <div class="icon-square d-flex align-items-center justify-content-center fs-4 flex-shrink-0 me-3 p-2 rounded-2" style="background-color: #2A6B77; width: 1.5em; height: 1.5em;">
                    <img class="rounded-2" src="{{ asset('front/img/gem.svg') }}" style="width: 1.5em; height: 1.5em;">
                </div>
                СОКРОВИЩА ИЗ СЛОВА БОГА
            </h4>
        </div>
        <div class="card-body">
            <form action="{{ route('meetingSchedules.save_treasures', $ms->id) }}" method="post">
                @csrf
                <div id="treasures-container">
                    @foreach($treasures as $key => $treasure)
                        <div class="row mb-2 d-flex justify-content-between align-items-end border p-1" data-key="{{ $key }}">
                            <div class="col-md-4">
                                <div class="form">
                                    <label for="treasure_name_{{ $key }}">Название:</label>
                                    <input type="text" name="treasures[{{ $key }}][name]" id="treasure_name_{{ $key }}" class="form-control" value="{{ $treasure['name'] }}" required>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <label for="treasures_value_{{ $key }}">Ведущий</label>
                                <select name="treasures[{{ $key }}][value]" id="treasure_value_{{ $key }}" class="form-control" required>
                                    <option value="" selected disabled>- Выберите пользователя -</option>
                                    @foreach ($users as $user)
                                        <option value="{{ $user['id'] }}" @if($user['id'] == $treasure['value']) selected @endif>
                                            {{ $user['last_name'] }} {{ $user['first_name'] }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-4">
                                <button type="button" class="col btn btn-outline-danger" onclick="removeTreasure(this)">Удалить</button>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="row">
                    <div class="col-6">
                        <button type="button" class="col btn btn-success" onclick="addTreasure()">Добавить</button>
                    </div>
                    <div class="col-6">
                        <button type="submit" class="col btn btn-primary">Сохранить</button>
                    </div>
                </div>
            </form>
        </div>
    </div>


<script>
    let nextTreasureKey = {{ count($treasures) }};

    function addTreasure() {
        nextTreasureKey++;
        const container = document.getElementById('treasures-container');
        const newRow = document.createElement('div');
        newRow.className = 'row mb-2 align-items-end border p-1';
        newRow.setAttribute('data-key', nextTreasureKey);
        newRow.innerHTML = `
            <div class="col-md-4">
                <div class="form">
                    <label for="treasure_name_${nextTreasureKey}">Название:</label>
                    <input type="text" name="treasures[${nextTreasureKey}][name]" id="treasure_name_${nextTreasureKey}" class="form-control" required>
                </div>
            </div>
            <div class="col-md-4">
                <label for="treasure_value_${nextTreasureKey}">
                    Ответственный
                </label>
                <select name="treasures[${nextTreasureKey}][value]" id="treasures_value_${nextTreasureKey}" class="form-control" required>
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
                <button type="button" class="col btn btn-outline-danger" onclick="removeTreasure(this)">Удалить</button>
            </div>
        `;
        container.appendChild(newRow);
    }

    function removeTreasure(button) {
        const container = document.getElementById('treasures-container');
        const rowToRemove = button.closest('.row');
        container.removeChild(rowToRemove);
    }
</script>
<script>
    $(document).ready(function() {
        $('#treasure_value_{{ $key }}').select2({
            placeholder: 'Введите имя пользователя',
            allowClear: true,
            tags: true,
        });
    });
    $(document).ready(function() {
        // Инициализация Select2 для существующих элементов при загрузке страницы
        $('[id^="treasure_value_"]').each(function() {
            $(this).select2({
                placeholder: 'Введите имя пользователя',
                allowClear: true,
                tags: true,
            });
        });
    });
</script>
