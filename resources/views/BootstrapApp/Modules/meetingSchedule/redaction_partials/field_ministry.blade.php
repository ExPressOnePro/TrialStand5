
<div class="card">
        <div class="card-header">
            <h4 class="pb-1 mb-1 d-flex align-items-center" style="color: #D68F00">
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
                        <div class="row mb-2 d-flex justify-content-between" data-key="{{ $key }}">
                            <div class="col-md-4">
                                <div class="form-floating mb-2">
                                    <input type="text" name="field_ministry[{{ $key }}][name]" id="field_ministry_name_{{ $key }}" class="form-control" value="{{ $fieldMinistryItem['name'] }}" required>
                                    <label for="field_ministry_name_{{ $key }}">Название:</label>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-floating mb-2">
                                    <input type="text" name="field_ministry[{{ $key }}][value]" id="field_ministry_value_{{ $key }}" class="form-control" value="{{ $fieldMinistryItem['value'] }}" required>
                                    <label for="field_ministry_value_{{ $key }}">Ведущий:</label>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-floating mb-2">
                                    <input type="text" name="field_ministry[{{ $key }}][value_2]" id="field_ministry_value_2_{{ $key }}" class="form-control" value="{{ $fieldMinistryItem['value_2'] ?? '' }}">
                                    <label for="field_ministry_value_2_{{ $key }}">Помошник:</label>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <button type="button" class="btn btn-danger" onclick="removeFieldMinistry(this)">Удалить</button>
                            </div>
                        </div>
                    @endforeach
                </div>

                <button type="button" class="btn btn-success" onclick="addFieldMinistry()">Добавить служение</button>
                <button type="submit" class="btn btn-primary">Сохранить</button>
            </form>
        </div>
    </div>


<script>
    let nextFieldMinistryKey = {{ count($fieldMinistry) }};

    function addFieldMinistry() {
        nextFieldMinistryKey++;
        const container = document.getElementById('field-ministry-container');
        const newRow = document.createElement('div');
        newRow.className = 'row mb-2';
        newRow.setAttribute('data-key', nextFieldMinistryKey);
        newRow.innerHTML = `
            <div class="col-md-4">
                <label for="field_ministry_name_${nextFieldMinistryKey}">Название:</label>
                <input type="text" name="field_ministry[${nextFieldMinistryKey}][name]" id="field_ministry_name_${nextFieldMinistryKey}" class="form-control" required>
            </div>
            <div class="col-md-4">
                <label for="field_ministry_value_${nextFieldMinistryKey}">Значение:</label>
                <input type="text" name="field_ministry[${nextFieldMinistryKey}][value]" id="field_ministry_value_${nextFieldMinistryKey}" class="form-control" required>
            </div>
            <div class="col-md-4">
                <label for="field_ministry_value_2_${nextFieldMinistryKey}">Второе значение:</label>
                <input type="text" name="field_ministry[${nextFieldMinistryKey}][value_2]" id="field_ministry_value_2_${nextFieldMinistryKey}" class="form-control">
            </div>
            <div class="col-md-4">
                <button type="button" class="btn btn-danger" onclick="removeFieldMinistry(this)">Удалить</button>
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
