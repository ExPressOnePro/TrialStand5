@extends('Mobile.layouts.front.app')
@section('title') Meeper | Собрание @endsection
@section('content')

    <div class="content container-fluid">
        <div class="row row-cols-1 row-cols-sm-2 row-cols-lg-3">
            @foreach($congregationRequests as $conReq)
                    <div class="col mb-3 mb-lg-5">
                        <!-- Card -->
                        <div class="card h-100">
                            <div class="card-pinned">
                                <div class="card-pinned-top-end">
                                </div>
                            </div>

                            <!-- Body -->
                            <div class="card-body text-center">
                                <!-- Avatar -->
                                <div class="avatar avatar-xl avatar-soft-primary avatar-circle avatar-centered mb-3">
                                    <span class="avatar-initials">G</span>
                                    <span class="avatar-status avatar-sm-status avatar-status-warning"></span>
                                </div>
                                <!-- End Avatar -->

                                <h3 class="mb-1">
                                    <a class="text-dark" href="#">{{ $conReq->user->first_name }} {{ $conReq->user->last_name }}</a>
                                </h3>

                                <div class="mb-3">
                                    <span>{{ $conReq->user->email }}</span>
                                </div>
                            </div>
                            <!-- End Body -->

                            <!-- Footer -->
                            <div class="card-footer">
                                <div class="row justify-content-between align-items-center">
                                    <div class="col-auto py-1">
                                        <a class="text-success mr-2" href="#">
                                            <button class="btn btn-danger" href="{{ route('congregationReject', [ 'id' => $conReq->congregation->id, 'conReq' => $conReq->id]) }}">Запретить</button>
                                        </a>
                                    </div>

                                    <div class="col-auto py-1">
                                        <a class="text-success mr-2" href="{{ route('congregationAllow', [ 'id' => $conReq->congregation->id, 'user_id' => $conReq->user_id, 'conReq' => $conReq->id]) }}">
                                            <button class="btn btn-success">Разрешить</button>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
        </div>
    </div>
@endsection
