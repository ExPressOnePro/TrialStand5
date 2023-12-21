@extends('Mobile.layouts.front.app')
@section('title') Meeper @endsection
@section('content')

    <div class="content container-fluid">

        <div class="page-header">
            <div class="d-flex mb-3">
                <div class="flex-grow-1">
                    <div class="row">
                        <div class="col-lg mb-3 mb-lg-0">
                            <h1 class="page-header-title">{{ $congregation->name }}</h1>
                            <div class="row align-items-center">
                                <div class="col-auto">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            @include('Mobile.menu.modules.congregation.components.navMenu')

            <div class="row">
                <div class="col-6 col-lg-3 mb-3 mb-lg-3">
                    <!-- Card -->
                    <div class="card h-100">
                        <div class="card-body">
                            <h6 class="card-subtitle mb-2">Всех возвещателей</h6>

                            <div class="row align-items-center gx-2">
                                <div class="col">
                                    <span class="js-counter display-4 text-dark" data-value="24">{{$usersCongregationCount}}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-lg-3 mb-3  mb-lg-3">
                    <div class="card h-100">
                        <div class="card-body">
                            <h6 class="card-subtitle mb-2">Активных пользователей за неделю</h6>
                            <div class="row align-items-center gx-2">
                                <div class="col">
                                    <span class="js-counter display-4 text-dark" data-value="12">{{$usersActiveCount}}</span>
                                    <span class="text-body fs-5 ms-1"> из {{$usersCongregationCount}}</span>
                                </div>

                                <div class="col-auto">
                                    <span class="badge bg-soft-success text-success p-1"><i class="bi-graph-up"></i> {{ number_format($usersActiveCountPercent, 2) }}%</span>
                                </div>
                            </div>

                        </div>
                    </div>

                </div>

            </div>
        </div>
    </div>


@endsection
