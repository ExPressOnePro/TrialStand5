
@if(Request::is('stand/currentWeek*',))
    <div class="row mt-3">
        <div class="col text-left ml-0">
            <a href="{{ route('currentWeekTable', $stand->id) }}">
                <button class="btn btn-info btn-block text-center">Текущая неделя</button>
            </a>
        </div>
        <div class="col text-right ml-0">
            <a href="{{ route('nextWeekTable', $stand->id) }}">
                <button class="btn btn-outline-info btn-block text-center">Следующая неделя</button>
            </a>
        </div>
    </div>
@else
    <div class="row mt-3">
        <div class="col text-left ml-0">
            <a href="{{ route('currentWeekTable', $stand->id) }}">
                <button class="btn btn-outline-info btn-block text-center">Текущая неделя</button>
            </a>
        </div>
        <div class="col text-right ml-0">
            <a href="{{ route('nextWeekTable', $stand->id) }}">
                <button class="btn btn-info btn-block text-center">Следующая неделя</button>
            </a>
        </div>
    </div>
@endif
