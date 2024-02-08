
<div class="card mb-5">
        <div class="card-header">
            <h4 class="pb-1 mb-1 d-flex align-items-center" style="color: #BF2F13">
                <div class="icon-square d-flex align-items-center justify-content-center fs-4 flex-shrink-0 me-3 p-2 rounded-2" style="background-color: #BF2F13; width: 1.5em; height: 1.5em;">
                    <img class="rounded-2" src="{{ asset('front/img/sheep.svg') }}" style="width: 1.5em; height: 1.5em;">
                </div>
                ХРИСТИАНСКАЯ ЖИЗНЬ
            </h4>
        </div>
        <div class="card-body">
            <form action="{{ route('meetingSchedules.save_living', $ms->id) }}" method="post">
                @csrf
                <div id="living-container">
                    @foreach($living as $key => $livingItem)
                        <div class="row mb-2 d-flex justify-content-between align-items-end border p-1" data-key="{{ $key }}">
                            <div class="col-md-3">
                                <div class="form">
                                    <label for="living_name_{{ $key }}">Название:</label>
                                    <input type="text" name="living[{{ $key }}][name]" id="living_name_{{ $key }}" class="form-control" value="{{ $livingItem['name'] }}" required>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form">
                                    <label for="living_value_{{ $key }}">Ведущий</label>
                                    <select name="living[{{ $key }}][value]" id="living_value_{{ $key }}" class="form-control" required>
                                        <option value="" selected disabled>- Выберите пользователя -</option>
                                        @foreach ($users as $user)
                                            <option value="{{ $user['id'] }}" @if(isset($livingItem['value']) && $user['id'] == $livingItem['value']) selected @endif>
                                                {{ $user['last_name'] }} {{ $user['first_name'] }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form">
                                    <label for="living_value_{{ $key }}">Чтец</label>
                                    <select name="living[{{ $key }}][value_2]" id="living_value_2_{{ $key }}" class="form-control">
                                        <option value="" selected disabled>- Выберите пользователя -</option>
                                        @foreach ($users as $user)
                                            <option value="{{ $user['id'] }}" @if(isset($livingItem['value_2']) && $user['id'] == $livingItem['value_2']) selected @endif>
                                                {{ $user['last_name'] }} {{ $user['first_name'] }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3 mt-3">
                                <button type="button" class="col btn btn-outline-danger" onclick="removeLiving(this)">Удалить</button>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="row">
                    <div class="col-6">
                        <button type="button" class="col btn btn-success" onclick="addLiving()">Добавить</button>
                    </div>
                    <div class="col-6">
                        <button type="submit" class="col btn btn-primary">Сохранить</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

<script>
    let nextLivingKey = {{ count($living) }};

    function addLiving() {
        nextLivingKey++;
        const container = document.getElementById('living-container');
        const newRow = document.createElement('div');
        newRow.className = 'row mb-2 align-items-end border p-1';
        newRow.setAttribute('data-key', nextLivingKey);
        newRow.innerHTML = `
            <div class="col-md-3">
    <div class="form">
        <label for="living_name_${nextLivingKey}">Название:</label>
        <input type="text" name="living[${nextLivingKey}][name]" id="living_name_${nextLivingKey}" class="form-control" required>
    </div>
</div>
<div class="col-md-3">
    <label for="treasure_value_${nextLivingKey}">
        Ведущий
    </label>
    <select name="living[${nextLivingKey}][value]" id="living_value_${nextLivingKey}" class="form-control" required>
        <option value="" selected disabled>- Выберите пользователя -</option>
        @foreach ($users as $user)
        <option value="{{ $user['id'] }}">
                {{ $user['last_name'] }} {{ $user['first_name'] }}
        </option>
@endforeach
        </select>
    </div>
    <div class="col-md-3">

            <label for="treasure_value_${nextLivingKey}">
            Чтец
        </label>
        <select name="living[${nextLivingKey}][value_2]" id="living_value_2_${nextLivingKey}" class="form-control">
            <option value="" selected disabled>- Выберите пользователя -</option>
            @foreach ($users as $user)
        <option value="{{ $user['id'] }}">
                    {{ $user['last_name'] }} {{ $user['first_name'] }}
        </option>
@endforeach
        </select>

</div>
<div class="col-md-3 mt-3">
    <button type="button" class="col btn btn-outline-danger" onclick="removeLiving(this)">Удалить</button>
</div>
`;
        container.appendChild(newRow);
    }

    function removeLiving(button) {
        const container = document.getElementById('living-container');
        const rowToRemove = button.closest('.row');
        container.removeChild(rowToRemove);
    }
</script>
