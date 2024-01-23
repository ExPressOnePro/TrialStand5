
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
                        <div class="row mb-2 d-flex justify-content-between" data-key="{{ $key }}">
                            <div class="col-md-4">
                                <div class="form-floating mb-2">
                                    <input type="text" name="treasures[{{ $key }}][name]" id="treasure_name_{{ $key }}" class="form-control" value="{{ $treasure['name'] }}" required>
                                    <label for="treasure_name_{{ $key }}">Название:</label>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-floating mb-2">
                                    <input type="text" name="treasures[{{ $key }}][value]" id="treasure_value_{{ $key }}" class="form-control" value="{{ $treasure['value'] }}" required>
                                    <label for="treasure_value_{{ $key }}">Значение:</label>
                                </div>
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
        newRow.className = 'row mb-2';
        newRow.setAttribute('data-key', nextTreasureKey);
        newRow.innerHTML = `
            <div class="col-md-4">
                 <div class="form-floating mb-2">
                <input type="text" name="treasures[${nextTreasureKey}][name]" id="treasure_name_${nextTreasureKey}" class="form-control" required>
                <label for="treasure_name_${nextTreasureKey}">Название:</label>
            </div>
            </div>
            <div class="col-md-4">
                 <div class="form-floating mb-2">
                <input type="text" name="treasures[${nextTreasureKey}][value]" id="treasure_value_${nextTreasureKey}" class="form-control" required>
                <label for="treasure_value_${nextTreasureKey}">Значение:</label>
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
