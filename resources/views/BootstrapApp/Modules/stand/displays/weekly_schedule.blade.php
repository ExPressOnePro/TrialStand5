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


            <div id="preloader" class="text-center" style="display: none;">
                <div class="spinner-border" style="width: 3rem; height: 3rem;" role="status">
                    <span class="sr-only">...</span>
                </div>
            </div>

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
                <div id="dynamic-content-current2">
                </div>
{{--                @include('BootstrapApp.Modules.stand.components.Example')--}}
                <script>
                    $(document).ready(function () {

                        loadDynamicContent('menu');
                    });

                    function loadDynamicContent(page) {
                        $('#preloader').show();
                        $.ajax({
                            url: "{{ route('stand.tableEx', $stand->id) }}",
                            type: "GET",
                            success: function (data) {
                                $('#preloader').hide();
                                $('#dynamic-content-current2').html(data);
                            },
                            error: function (error) {
                                $('#preloader').hide();
                                console.error(error);
                            }
                        });
                    }
                </script>
            @elseif(Request::is('*/next2*'))
                @if(date('N') . '-' . date('H:i') >= $activation)

                    @include('BootstrapApp.Modules.stand.components.Example')


                    {{--                @include('BootstrapApp.Modules.stand.components.Example')--}}

                @else
                    <div class="not-found-wrap text-center">
                        <h1 class="heading">Следующая неделя будет доступна</h1>
                        <h1 class="mb-5 text-muted text-20">{{ $dayName }} {{ $activation_value[1] }}</h1>
                    </div>
                @endif
            @endif

        </div>
    @endcan

@endsection
