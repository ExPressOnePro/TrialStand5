{{--@extends('Mobile.layouts.front.app')--}}
@extends('BootstrapApp.layouts.bootstrapApp')
@section('title') Meeper @endsection
@section('content')

        @can('module.stand')

            <div class="content container-fluid">

{{--                @include('Mobile.includes.alerts.alerts')--}}
                @include('BootstrapApp.includes.alerts')
                @include('Modules.stand.components.switch_week')
                @include('Modules.stand.components.Example')
                @if(isset($userInfo["stand_settings"]) && $userInfo["stand_settings"] == 1  && date('N') . '-' . date('H:i') >= $activation)
                        @include('Modules.stand.components.aio_table')
                    @elseif(Request::is('*next*') && $currentDateTime >= $activationDateTime)
                        <div class="not-found-wrap text-center">
                            <h1 class="heading">Следующая неделя будет доступна</h1>
                            <h1 class="mb-5 text-muted text-20">{{ $dayName }} {{ $activation_value[1] }}</h1>
                        </div>
                    @else
                        @include('Modules.stand.components.aio_table')
                    @endif
                @else
                    @if(Request::is('*/next*') && date('N') . '-' . date('H:i') >= $activation)
                        @include('Modules.stand.components.Example')
                    @elseif(Request::is('*/next*') && $currentDateTime >= $activationDateTime)
                        <div class="not-found-wrap text-center">
                            <h1 class="heading">Следующая неделя будет доступна</h1>
                            <h1 class="mb-5 text-muted text-20">{{ $dayName }} {{ $activation_value[1] }}</h1>
                        </div>
                    @else
                        @include('Modules.stand.components.Example')
                    @endif
                @endif
            </div>

        @endcan
@endsection
