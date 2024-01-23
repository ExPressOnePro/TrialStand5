<div class="card">
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
                    <div class="row mb-2 d-flex justify-content-between" data-key="{{ $key }}">
                        <div class="col-md-3">
                            <div class="form-floating mb-2">
                                <input type="text" name="watchtower[{{ $key }}][name]" id="tower_name_{{ $key }}" class="form-control" value="{{ $tower['name'] }}" required>
                                <label for="tower_name_{{ $key }}">Название:</label>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-floating mb-2">
                                <input type="text" name="watchtower[{{ $key }}][value]" id="tower_value_{{ $key }}" class="form-control" value="{{ $tower['value'] }}" required>
                                <label for="tower_value_{{ $key }}">Значение:</label>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-floating mb-2">
                                <input type="text" name="watchtower[{{ $key }}][value_2]" id="tower_value_2_{{ $key }}" class="form-control" value="{{ $tower['value_2'] ?? '' }}">
                                <label for="ftower_value_2_{{ $key }}">Чтец:</label>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <button type="button" class="col btn btn-outline-danger" onclick="removeWatchtower(this)">Удалить</button>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="row">
                <div class="col-6">
                    <button type="button" class="col btn btn-success" onclick="addWatchtower()">Добавить</button>
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
        newRow.className = 'row mb-2';
        newRow.setAttribute('data-key', nextWatchtowerKey);
        newRow.innerHTML = `
            <div class="col-md-3">
                <div class="form-floating mb-2">
                    <input type="text" name="watchtower[${nextWatchtowerKey}][name]" id="tower_name_${nextWatchtowerKey}" class="form-control" required>
                    <label for="tower_name_${nextWatchtowerKey}">Название:</label>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-floating mb-2">
                    <input type="text" name="watchtower[${nextWatchtowerKey}][value]" id="tower_value_${nextWatchtowerKey}" class="form-control" required>
                    <label for="tower_value_${nextWatchtowerKey}">Значение:</label>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-floating mb-2">
                    <input type="text" name="watchtower[${nextWatchtowerKey}][value_2]" id="tower_value_${nextWatchtowerKey}" class="form-control" required>
                    <label for="tower_value_${nextWatchtowerKey}">Значение:</label>
                </div>
            </div>
            <div class="col-md-3">
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
