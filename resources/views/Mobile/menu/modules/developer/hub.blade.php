@extends('Mobile.layouts.front.app')
@section('title') Meeper | Собрание @endsection
@section('content')

    <div class="content container-fluid">

        <div class="row">
            @foreach($metrics as $metric)
                <div class="col-sm-6 col-xl-3 mb-3 mb-xl-6">
                    <a class="card card-sm card-hover-shadow border-secondary h-100" href="{{ $metric['route'] }}">
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <!-- Media -->
                                    <div class="d-flex">
                                        <div class="flex-grow-1 ms-3">
                                            <h4 class="mb-1">{{ $metric['title'] }}</h4>
                                            @if(isset($metric['percent']))
                                                <span class="badge bg-soft-success text-success p-1">
                                        <i class="bi-graph-up"></i>{{ number_format($metric['percent'], 2) }} %
                                    </span>
                                            @endif
                                        </div>
                                    </div>
                                    <!-- End Media -->
                                </div>
                                <!-- End Col -->
                                <div class="col-auto">
                                    <!-- Circle -->
                                    <div class="js-counter h1 mb-1">{{$metric['count']}}</div>
{{--                                    <div class="js-circle"--}}
{{--                                         data-hs-circles-options='{--}}
{{--                                    "value": {{ $metric['count'] }},--}}
{{--                                    "maxValue": 500,--}}
{{--                                    "duration": 1000,--}}
{{--                                    "isViewportInit": true,--}}
{{--                                    "colors": ["rgba(55, 125, 255, 0.1)", "#377dff"],--}}
{{--                                    "radius": 25,--}}
{{--                                    "width": 3,--}}
{{--                                    "textFontSize": 22,--}}
{{--                                    "additionalText": "",--}}
{{--                                    "textClass": "circles-chart-content",--}}
{{--                                    "textColor": "#377dff"--}}
{{--                                }'></div>--}}
                                    <!-- End Circle -->
                                </div>
                                <!-- End Col -->
                            </div>
                            <!-- End Row -->
                        </div>
                    </a>
                </div>
            @endforeach
        </div>

    </div>

@endsection
