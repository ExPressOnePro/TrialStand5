
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
                        <div class="row mb-2 d-flex justify-content-between" data-key="{{ $key }}">
                            <div class="col-md-4">
                                <div class="form-floating mb-2">
                                    <input type="text" name="responsibles[{{ $key }}][name]" id="name_{{ $key }}" class="form-control" value="{{ $responsible['name'] }}" required>
                                    <label for="name_{{ $key }}">Название:</label>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-floating mb-2">
                                    <input type="text" name="responsibles[{{ $key }}][value]" id="value_{{ $key }}" class="form-control" value="{{ $responsible['value'] }}" required>
                                    <label for="value_{{ $key }}">Ведущий:</label>
                                </div>
                            </div>
                            <div class="col-md-4">
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
        newRow.className = 'row mb-2';
        newRow.setAttribute('data-key', nextKey);
        newRow.innerHTML = `
            <div class="col-md-4">
                 <div class="form-floating mb-2">
                    <input type="text" name="responsibles[${nextKey}][name]" id="name_${nextKey}" class="form-control" required>
                    <label for="name_${nextKey}">Название:</label>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-floating mb-2">
                    <input type="text" name="responsibles[${nextKey}][value]" id="value_${nextKey}" class="form-control" required>
                    <label for="value_${nextKey}">Ведущий:</label>
                </div>
            </div>
            <div class="col-md-4">
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

