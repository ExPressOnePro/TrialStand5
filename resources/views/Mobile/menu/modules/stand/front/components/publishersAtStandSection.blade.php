<div class="card-header">
    <h4 class="card-title">Возвещатели</h4>
</div>

<!-- Body -->
<div class="card-body">
    <p>Укажите количество возвещателей служащих со стендом <span class="fw-semibold"></span></p>

    <form action="{{ route('stand.publishersAtStand.update', ['id'=> $stand->id]) }}" method="POST">
        @csrf
        <div class="row mb-4">
            <div class="col-sm-9">
                <select class="form-control" name="publishersAtStand">
                    @for($number = 2; $number <= 4; $number++)
                        <option value="{{ $number }}" {{ $number == $settings_publishers_at_stand ? 'selected' : '' }}>
                            {{ $number }}
                        </option>
                    @endfor
                </select>
            </div>
        </div>
        <div class="d-flex justify-content-end">
            <button type="submit" class="btn btn-primary">Сохранить изменения</button>
        </div>
    </form>
</div>

