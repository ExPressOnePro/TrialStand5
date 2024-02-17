@extends('BootstrapApp.layouts.app')
@section('title') Meeper | Собрание @endsection
@section('content')

    <div class="content container-fluid">

        <div class="row mb-5">
            @foreach($metrics as $metric)
                <div class="col-md-6">
                    <div class="my-3 p-3 bg-body rounded shadow-sm mb-0 small lh-sm w-100 d-flex justify-content-between align-items-center">
                        <div>
                            <a class="text-muted text-decoration-none h4" href="{{ $metric['route'] }}">
                                {{ $metric['title'] }}
                            </a>
                            <div class="d-flex align-items-center">
                                @if(isset($metric['count']))
                                    <p class="h2 me-2">{{$metric['count']}}</p>
                                @endif
                                @if(isset($metric['percent']))
                                    <span class="badge text-bg-primary">
                                            <i class="fa-solid fa-chart-line"></i>
                                            {{ number_format($metric['percent'], 2) }} %
                                        </span>
                                @endif
                            </div>
                        </div>
                        <a class="btn btn-outline-secondary" href="{{ $metric['route'] }}"><i class="bi-chevron-right text-body text-inherit"></i></a>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="col mb-5 mb-lg-5 mt-3">
            <div class="list-group d-flex align-items-center">
                <a class="list-group-item list-group-item-action border border-1 border-danger" href="/log-viewer">
                    <div class="d-flex align-items-center m-2">
                        <div class="ms-3">
                            <span class="d-block h1 text-inherit mb-0">Log-viewer</span>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>

@endsection
