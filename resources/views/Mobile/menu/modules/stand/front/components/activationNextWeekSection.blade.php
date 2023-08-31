<div class="card-header">
    <h4 class="card-title">Активация </h4>
</div>

<!-- Body -->
<div class="card-body">
    <p>Время в которое отображается таблица следующей недели<span class="fw-semibold"></span></p>

    <form action="{{ route('timeActivation', ['id' => $stand->id]) }}" method="post" id="timeActivation">
        @csrf

        <div class="row mb-4">
            <div class="col-6">
                <select class="form-control text-left" name="dayOfWeek">
                    @foreach($daysOfWeek as $dayNumber => $dayName)
                        <option value="{{ $dayNumber }}" {{ $dayNumber == $activation_values[0] ? 'selected' : '' }}>
                            {{ $dayName }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-6">
                <select class="form-control text-center" id="time" name="time">
                    @for($hour = 0; $hour < 24; $hour++)
                        @for($minute = 0; $minute < 60; $minute += 60)
                            <option value="{{ sprintf('%02d:%02d', $hour, $minute) }}" {{ $activation_values[1] == sprintf('%02d:%02d', $hour, $minute) ? 'selected' : '' }}>
                                {{ sprintf('%02d:%02d', $hour, $minute) }}
                            </option>
                        @endfor
                    @endfor
                </select>
            </div>
        </div>
        <div class="d-flex justify-content-end">
            <button type="submit" class="btn btn-primary">Сохранить изменения</button>
        </div>
    </form>
</div>

