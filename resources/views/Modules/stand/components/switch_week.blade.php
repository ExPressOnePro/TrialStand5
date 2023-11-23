<div class="row mb-4">
    <div class="col-6">
        <div class="d-grid gap-2">
            @if(Request::is('*stand/current*'))
                <a class="btn btn-primary" type="button" href="{{ route('stand.current', $stand->id) }}">{{ __('text.Текущая') }}</a>
            @elseif (Request::is('*stand/next*'))
                <a class="btn btn-outline-primary" type="button" href="{{ route('stand.current', $stand->id) }}">{{ __('text.Текущая') }}</a>

            @elseif (Request::is('*stand/aio_current*'))
                <a class="btn btn-primary" type="button" href="{{ route('stand.aio_current') }}">{{ __('text.Текущая') }}</a>

            @elseif (Request::is('*stand/aio_next*'))
                <a class="btn btn-outline-primary" type="button" href="{{ route('stand.aio_current') }}">{{ __('text.Текущая') }}</a>
            @endif

        </div>
    </div>
    <div class="col-6">
        <div class="d-grid gap-2">
            @if(Request::is('*stand/next*'))
                <a class="btn btn-primary" type="button" href="{{ route('stand.next', $stand->id) }}">{{ __('text.Следующая') }}</a>
            @elseif(Request::is('*stand/current*'))
                <a class="btn btn-outline-primary" type="button" href="{{ route('stand.next', $stand->id) }}">{{ __('text.Следующая') }}</a>
            @elseif (Request::is('*stand/aio_next*'))
                <a class="btn btn-primary" type="button" href="{{ route('stand.aio_next') }}">{{ __('text.Следующая') }}</a>
            @elseif (Request::is('*stand/aio_current*'))
                <a class="btn btn-outline-primary" type="button" href="{{ route('stand.aio_next') }}">{{ __('text.Следующая') }}</a>
            @endif
        </div>
    </div>
</div>

