@extends('Mobile.layouts.front.app')
@section('title') Meeper @endsection
@section('content')
    <style>
        .overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(255, 255, 255, 0.7);
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 9999;
        }

        .spinner-border {
            width: 3rem;
            height: 3rem;
        }
    </style>
    @include('Mobile.includes.loadingOverlay')
    @can('module.stand')
        <div class="content container-fluid">
            @include('Mobile.includes.alerts.alerts')
            @include('Modules.stand.components.switch_week')



            @if(Request::is('*aio_current*'))
                @include('Modules.stand.components.aio_table')
            @elseif(Request::is('*aio_next*'))
                @if(date('N') . '-' . date('H:i') >= $activation)
                    @include('Modules.stand.components.aio_table')
                @else
                    <div class="not-found-wrap text-center">
                        <h1 class="heading">Следующая неделя будет доступна</h1>
                        <h1 class="mb-5 text-muted text-20">{{ $dayName }} {{ $activation_value[1] }}</h1>
                    </div>
                @endif
            @endif

            @if(Request::is('*/current*'))
                @include('Modules.stand.components.table')
            @elseif(Request::is('*/next*'))
                @if(date('N') . '-' . date('H:i') >= $activation))
                @include('Modules.stand.components.table')
                @else
                    <div class="not-found-wrap text-center">
                        <h1 class="heading">Следующая неделя будет доступна</h1>
                        <h1 class="mb-5 text-muted text-20">{{ $dayName }} {{ $activation_value[1] }}</h1>
                    </div>
                @endif
            @endif

{{--            @if(isset($userInfo["stand_settings"]) && $userInfo["stand_settings"] == 1)--}}
{{--                @if(Request::is('*aio_next*') && $currentDateTime >= $activationDateTime)--}}
{{--                    @include('Modules.stand.components.aio_table')--}}
{{--                @elseif(Request::is('*aio_current*'))--}}
{{--                    @include('Modules.stand.components.aio_table')--}}
{{--                @else--}}
{{--                    <div class="not-found-wrap text-center">--}}
{{--                        <h1 class="heading">Следующая неделя будет доступна</h1>--}}
{{--                        <h1 class="mb-5 text-muted text-20">{{ $dayName }} {{ $activation_value[1] }}</h1>--}}
{{--                    </div>--}}
{{--                @endif--}}
{{--            @else--}}
{{--                @if(Request::is('*current*'))--}}
{{--                    @include('Modules.stand.components.table')--}}
{{--                @elseif(Request::is('*next*') && date('N') >= $activation[0] && date('H:i') >= $activationDateTime)--}}
{{--                    @include('Modules.stand.components.table')--}}
{{--                @else--}}
{{--                    <div class="not-found-wrap text-center">--}}
{{--                        <h1 class="heading">Следующая неделя будет доступна</h1>--}}
{{--                        <h1 class="mb-5 text-muted text-20">{{ $dayName }} {{ $activation_value[1] }}</h1>--}}
{{--                    </div>--}}
{{--                @endif--}}
{{--            @endif--}}
        </div>
    @endcan
@endsection
