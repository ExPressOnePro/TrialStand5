<div class="row mb-4">
    <div class="col-6">
        <div class="d-grid gap-2">
            @if(Request::is('*stand/currentWeekFront*'))
                <a class="btn btn-primary" type="button" href="{{ route('currentWeekTableFront', $stand->id) }}">Текущая</a>
            @elseif (Request::is('*stand/nextWeekFront*'))
                <a class="btn btn-outline-primary" type="button" href="{{ route('currentWeekTableFront', $stand->id) }}">Текущая</a>

            @elseif (Request::is('*stand/aio_current*'))
                <a class="btn btn-primary" type="button" href="{{ route('stand.allInOneCurrent') }}">Текущая</a>

            @elseif (Request::is('*stand/aio_next*'))
                <a class="btn btn-outline-primary" type="button" href="{{ route('stand.allInOneCurrent') }}">Текущая</a>
            @endif

        </div>
    </div>
    <div class="col-6">
        <div class="d-grid gap-2">
            @if(Request::is('*stand/nextWeekFront*'))
                <a class="btn btn-primary" type="button" href="{{ route('nextWeekTableFront', $stand->id) }}">Следующая</a>
            @elseif(Request::is('*stand/currentWeekFront*'))
                <a class="btn btn-outline-primary" type="button" href="{{ route('nextWeekTableFront', $stand->id) }}">Следующая</a>

            @elseif (Request::is('*stand/aio_next*'))
                <a class="btn btn-primary" type="button" href="{{ route('stand.allInOneNext') }}">Следующая</a>

            @elseif (Request::is('*stand/aio_current*'))
                <a class="btn btn-outline-primary" type="button" href="{{ route('stand.allInOneNext') }}">Следующая</a>
            @endif

        </div>
    </div>
</div>

