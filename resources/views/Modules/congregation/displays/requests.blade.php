@extends('Mobile.layouts.front.app')
@section('title') Meeper | Собрание @endsection
@section('content')


    <div class="content container-fluid">
        <div class="page-header">
            <h1 class="display-4 page-header-title">{{ $congregation->name }}</h1>
            <h1 class="page-header-title text-secondary">Запросы для добавления к собранию</h1>
        </div>

        <div class="row row-cols-1 row-cols-sm-2 row-cols-lg-3">
            @if($congregationRequestsCount > 0)
                @foreach($congregationRequests as $conReq)
                    <div class="col mb-3 mb-lg-5">
                        <!-- Card -->
                        <div class="card h-100">
                            <!-- Body -->
                            <div class="card-body">
                                <div class="row">
                                    <div class="col">
                                        <h3 class="mb-1">
                                            <a class="text-dark" href="#">{{ $conReq->user->first_name }} {{ $conReq->user->last_name }}</a>
                                        </h3>
                                        <div class="mb-3">
                                            <span>{{ $conReq->user->email }}</span>
                                        </div>
                                    </div>
                                    <div class="col-end">
                                        <div class="row justify-content-between align-items-center">
                                            <div class="col-auto py-1">
                                                <a class="text-success mr-2" href="#">
                                                    <button class="btn btn-danger" href="{{ route('congregationReject', [ 'id' => $congregation->id, 'conReq' => $conReq->id]) }}">Запретить</button>
                                                </a>
                                            </div>

                                            <div class="col-auto py-1">
                                                <a class="text-success mr-2" href="{{ route('congregationAllow', [ 'id' => $congregation->id, 'user_id' => $conReq->user_id, 'conReq' => $conReq->id]) }}">
                                                    <button class="btn btn-success">Разрешить</button>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            @else
            @endif
        </div>
    </div>
@endsection
