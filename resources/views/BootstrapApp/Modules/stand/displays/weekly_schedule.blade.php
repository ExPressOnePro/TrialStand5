@extends('BootstrapApp.layouts.bootstrapApp')
@section('title') Meeper @endsection
@section('content')

    @include('BootstrapApp.includes.loadingOverlay')
    @can('module.stand')
        <div class="content container-fluid">
            @include('BootstrapApp.includes.alerts')
            @include('BootstrapApp.Modules.stand.components.switch_week')

{{--        @include('BootstrapApp.Modules.stand.components.Example')--}}
{{--            @include('BootstrapApp.Modules.stand.components.aio_table')--}}
{{--            <div id="dayRows" class="row"></div>--}}
{{--            @include('BootstrapApp.Modules.stand.components.tryScript')--}}

            @if(Request::is('*aio_current2*'))
                @include('BootstrapApp.Modules.stand.components.aio_table')
            @elseif(Request::is('*aio_next2*'))
                @if(date('N') . '-' . date('H:i') >= $activation)
                    @include('BootstrapApp.Modules.stand.components.aio_table')
                @else
                    <div class="not-found-wrap text-center">
                        <h1 class="heading">Следующая неделя будет доступна</h1>
                        <h1 class="mb-5 text-muted text-20">{{ $dayName }} {{ $activation_value[1] }}</h1>
                    </div>
                @endif
            @endif

            @if(Request::is('*/current2*'))
                @include('BootstrapApp.Modules.stand.components.Example')
            @elseif(Request::is('*/next2*'))
                @if(date('N') . '-' . date('H:i') >= $activation))
                    @include('BootstrapApp.Modules.stand.components.Example')
                @else
                    <div class="not-found-wrap text-center">
                        <h1 class="heading">Следующая неделя будет доступна</h1>
                        <h1 class="mb-5 text-muted text-20">{{ $dayName }} {{ $activation_value[1] }}</h1>
                    </div>
                @endif
            @endif


{{--                @if(isset($userInfo["stand_settings"]) && $userInfo["stand_settings"] == 1)--}}
{{--                    @include('BootstrapApp.Modules.stand.components.aio_table')--}}
{{--                @elseif(date('N') . '-' . date('H:i') >= $activation)--}}
{{--                    @include('BootstrapApp.Modules.stand.components.aio_table')--}}
{{--                @else--}}
{{--                    <div class="not-found-wrap text-center">--}}
{{--                        <h1 class="heading">Следующая неделя будет доступна</h1>--}}
{{--                        <h1 class="mb-5 text-muted text-20">{{ $dayName }} {{ $activation_value[1] }}</h1>--}}
{{--                    </div>--}}
{{--                @endif--}}
{{--            @elseif(Request::is('*/current*'))--}}
{{--                @if(isset($userInfo["stand_settings"]))--}}
{{--                    @if($userInfo["stand_settings"] == 0))--}}
{{--                @include('BootstrapApp.Modules.stand.components.Example')--}}
{{--                    @if(Request::is('*/current*'))--}}
{{--                        @include('BootstrapApp.Modules.stand.components.Example')--}}
{{--                    @elseif(date('N') . '-' . date('H:i') >= $activation)--}}
{{--                        @include('BootstrapApp.Modules.stand.components.Example')--}}
{{--                    @else--}}
{{--                        <div class="not-found-wrap text-center">--}}
{{--                            <h1 class="heading">Следующая неделя будет доступна</h1>--}}
{{--                            <h1 class="mb-5 text-muted text-20">{{ $dayName }} {{ $activation_value[1] }}</h1>--}}
{{--                        </div>--}}
{{--                    @endif--}}
{{--            @endif--}}

{{--                    @include('BootstrapApp.Modules.stand.components.aio_table')--}}
{{--                @elseif(Request::is('*aio_next*') && date('N') >= $activation_value[0] && date('H:i') >= $activation_value[1])--}}
{{--                    @include('BootstrapApp.Modules.stand.components.aio_table')--}}
{{--                @else--}}
{{--                    <div class="not-found-wrap text-center">--}}
{{--                        <h1 class="heading">Следующая неделя будет доступна</h1>--}}
{{--                        <h1 class="mb-5 text-muted text-20">{{ $dayName }} {{ $activation_value[1] }}</h1>--}}
{{--                    </div>--}}
{{--                @endif--}}
{{--            @else--}}
{{--                @if(Request::is('*/current*'))--}}
{{--                    @include('BootstrapApp.Modules.stand.components.Example')--}}
{{--                @elseif(Request::is('*/next*') && date('N') >= $activation_value[0] && date('H:i') >= $activation_value[1])--}}
{{--                    @include('BootstrapApp.Modules.stand.components.Example')--}}
{{--                @else--}}
{{--                    <div class="not-found-wrap text-center">--}}
{{--                        <h1 class="heading">Следующая неделя будет доступна</h1>--}}
{{--                        <h1 class="mb-5 text-muted text-20">{{ $dayName }} {{ $activation_value[1] }}</h1>--}}
{{--                    </div>--}}
{{--                @endif--}}
{{--            @endif--}}
{{--            @if(isset($userInfo["stand_settings"]) && $userInfo["stand_settings"] == 1)--}}
{{--                @if(Request::is('*aio_next*') && date('N') >= $activation[0] && date('H:i') >= $activationDateTime)--}}
{{--                    @include('BootstrapApp.Modules.stand.components.aio_table')--}}
{{--                @elseif(Request::is('*aio_current*'))--}}
{{--                    @include('BootstrapApp.Modules.stand.components.aio_table')--}}
{{--                @else--}}
{{--                    <div class="not-found-wrap text-center">--}}
{{--                        <h1 class="heading">Следующая неделя будет доступна</h1>--}}
{{--                        <h1 class="mb-5 text-muted text-20">{{ $dayName }} {{ $activation_value[1] }}</h1>--}}
{{--                    </div>--}}
{{--                @endif--}}
{{--            @else--}}
{{--                @if(Request::is('*/next*') && date('N') >= $activation[0] && date('H:i') >= $activationDateTime)--}}
{{--                    @include('BootstrapApp.Modules.stand.components.Example')--}}
{{--                @elseif(Request::is('*/current*'))--}}
{{--                    @include('BootstrapApp.Modules.stand.components.Example')--}}
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
