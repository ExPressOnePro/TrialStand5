<div class="row mb-4">
    <div class="col-6">
        <div class="d-grid gap-2">
            @if(Request::is('*stand/current*'))
                <a class="btn btn-primary" type="button" href="{{ route('stand.current2', $stand->id) }}">{{ __('text.Текущая') }}</a>
            @elseif (Request::is('*stand/next*'))
                <a class="btn btn-outline-primary" type="button" href="{{ route('stand.current2', $stand->id) }}">{{ __('text.Текущая') }}</a>

            @elseif (Request::is('*stand/aio_current*'))
                <a class="btn btn-primary" type="button" href="{{ route('stand.aio_current2') }}">{{ __('text.Текущая') }}</a>

            @elseif (Request::is('*stand/aio_next*'))
                <a class="btn btn-outline-primary" type="button" href="{{ route('stand.aio_current2') }}">{{ __('text.Текущая') }}</a>
            @endif

        </div>
    </div>
    <div class="col-6">
        <div class="d-grid gap-2">
            @if(Request::is('*stand/next*'))
                <a class="btn btn-primary" type="button" href="{{ route('stand.next2', $stand->id) }}">{{ __('text.Следующая') }}</a>
            @elseif(Request::is('*stand/current*'))
                <a class="btn btn-outline-primary" type="button" href="{{ route('stand.next2', $stand->id) }}">{{ __('text.Следующая') }}</a>
            @elseif (Request::is('*stand/aio_next*'))
                <a class="btn btn-primary" type="button" href="{{ route('stand.aio_next2') }}">{{ __('text.Следующая') }}</a>
            @elseif (Request::is('*stand/aio_current*'))
                <a class="btn btn-outline-primary" type="button" href="{{ route('stand.aio_next2') }}">{{ __('text.Следующая') }}</a>
            @endif
        </div>
    </div>
</div>

