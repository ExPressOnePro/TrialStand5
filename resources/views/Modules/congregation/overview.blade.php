@extends('Mobile.layouts.front.app')
@section('title') Meeper @endsection
@section('content')


    <div class="content container-fluid">
                <div class="page-header">
                    @if($congregationRequestsCount)
                        <div class="alert alert-warning alert-dismissible fade show" role="alert">
                            <span class="fw-semibold">{{$congregationRequestsCount}}</span>
                            человек хотят присоединиться к вашему собранию
                            <a class="btn btn-outline-primary" href="{{route('congregation.requests', $congregation->id)}}">Открыть</a>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>

                    @endif
{{--                @include('Mobile.menu.modules.congregation.components.navMenu')--}}
                </div>
                <div class="row">
                    @foreach($metrics as $metric)
                        <div class="col-lg-3 mb-3 mb-lg-5">
                            <div class="d-grid gap-2 gap-lg-4">
                                <a class="card card-hover-shadow" href="{{ $metric['route'] }}">
                                    <div class="card-body">
                                        <div class="d-flex align-items-center">
                                            <div class="flex-shrink-0">
                                            </div>

                                            <div class="flex-grow-1 ms-4">
                                                <h5 class="text-inherit card-subtitle mb-1">{{ $metric['title'] }}</h5>
                                                <span class="js-counter display-4 text-dark">
                                                    @if(isset($metric['count']))
                                                        {{$metric['count']}}
                                                    @endif
                                                    </span>
                                                @if(isset($metric['percent']))
                                                    <span class="badge bg-soft-success text-success p-1">
                                        <i class="bi-graph-up"></i>{{ number_format($metric['percent'], 2) }} %
                                    </span>
                                                @endif
                                            </div>

                                            <div class="ms-2 text-end">
                                                <i class="bi-chevron-right text-body text-inherit"></i>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
    </div>


@endsection
