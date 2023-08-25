<div class="row mb-4">
    <div class="col-6">
        <div class="d-grid gap-2">
            @if(Request::is('*stand/currentWeekFront*'))
                <a class="btn btn-primary" type="button" href="{{ route('currentWeekTableFront', $stand->id) }}">Текущая</a>
            @else
                <a class="btn btn-outline-primary" type="button" href="{{ route('currentWeekTableFront', $stand->id) }}">Текущая</a>
            @endif
        </div>
    </div>
    <div class="col-6">
        <div class="d-grid gap-2">
            @if(Request::is('*stand/nextWeekFront*'))
                <a class="btn btn-primary" type="button" href="{{ route('nextWeekTableFront', $stand->id) }}">Следующая</a>
            @else
                <a class="btn btn-outline-primary" type="button" href="{{ route('nextWeekTableFront', $stand->id) }}">Следующая</a>
            @endif

        </div>
    </div>
</div>

