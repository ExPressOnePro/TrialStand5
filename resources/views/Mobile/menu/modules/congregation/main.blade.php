@extends('Mobile.layouts.front.app')
@section('title') Meeper | Собрание @endsection
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

            <!-- Navbar -->
            @include('Mobile.menu.modules.congregation.components.navMenu')

            <div class="row">
                <div class="col-sm-6 col-lg-3 mb-3 mb-lg-5">
                    <!-- Card -->
                    <div class="card h-100">
                        <div class="card-body">
                            <h6 class="card-subtitle mb-2">Total users</h6>

                            <div class="row align-items-center gx-2">
                                <div class="col">
                                    <span class="js-counter display-4 text-dark" data-value="24">24</span>
                                    <span class="text-body fs-5 ms-1">from 22</span>
                                </div>
                                <!-- End Col -->

                                <div class="col-auto">
                  <span class="badge bg-soft-success text-success p-1">
                    <i class="bi-graph-up"></i> 5.0%
                  </span>
                                </div>
                                <!-- End Col -->
                            </div>
                            <!-- End Row -->
                        </div>
                    </div>
                    <!-- End Card -->
                </div>

                <div class="col-sm-6 col-lg-3 mb-3 mb-lg-5">
                    <!-- Card -->
                    <div class="card h-100 шеу">
                        <div class="card-body">
                            <h6 class="card-subtitle mb-2">Активных пользователей за неделю</h6>

                            <div class="row align-items-center gx-2">
                                <div class="col">
                                    <span class="js-counter display-4 text-dark" data-value="12">{{$usersActiveCount}}</span>
                                    <span class="text-body fs-5 ms-1"> из {{$usersCongregationCount}}</span>
                                </div>

                                <div class="col-auto">
                  <span class="badge bg-soft-success text-success p-1">
                    <i class="bi-graph-up"></i> {{ number_format($usersActiveCountPercent, 2) }}%
                  </span>
                                </div>
                            </div>
                            <!-- End Row -->
                        </div>
                    </div>
                    <!-- End Card -->
                </div>

                <div class="col-sm-6 col-lg-3 mb-3 mb-lg-5">
                    <!-- Card -->
                    <div class="card h-100">
                        <div class="card-body">
                            <h6 class="card-subtitle mb-2">New/returning</h6>

                            <div class="row align-items-center gx-2">
                                <div class="col">
                                    <span class="js-counter display-4 text-dark" data-value="56">56</span>
                                    <span class="display-4 text-dark">%</span>
                                    <span class="text-body fs-5 ms-1">from 48.7</span>
                                </div>

                                <div class="col-auto">
                  <span class="badge bg-soft-danger text-danger p-1">
                    <i class="bi-graph-down"></i> 2.8%
                  </span>
                                </div>
                            </div>
                            <!-- End Row -->
                        </div>
                    </div>
                    <!-- End Card -->
                </div>

                <div class="col-sm-6 col-lg-3 mb-3 mb-lg-5">
                    <!-- Card -->
                    <div class="card h-100">
                        <div class="card-body">
                            <h6 class="card-subtitle mb-2">Active members</h6>

                            <div class="row align-items-center gx-2">
                                <div class="col">
                                    <span class="js-counter display-4 text-dark" data-value="28">28</span>
                                    <span class="display-4 text-dark">%</span>
                                    <span class="text-body fs-5 ms-1">from 28.6%</span>
                                </div>

                                <div class="col-auto">
                                    <span class="badge bg-soft-secondary text-secondary p-1">0.0%</span>
                                </div>
                            </div>
                            <!-- End Row -->
                        </div>
                    </div>
                    <!-- End Card -->
                </div>
            </div>

        </div>

{{--        <div class="tab-content">--}}
{{--            <div class="tab-pane fade show active" id="nav-one-eg1" role="tabpanel" aria-labelledby="nav-one-eg1-tab">--}}
{{--                @include('Mobile.menu.modules.congregation.components.overview')--}}
{{--            </div>--}}
{{--            <div class="tab-pane fade" id="nav-two-eg1" role="tabpanel" aria-labelledby="nav-two-eg1-tab">--}}
{{--                @include('Mobile.menu.modules.congregation.components.publishers')--}}
{{--            </div>--}}
{{--            <div class="tab-pane fade" id="nav-three-eg1" role="tabpanel" aria-labelledby="nav-three-eg1-tab">--}}
{{--                @include('Mobile.menu.modules.congregation.components.reports')--}}
{{--            </div>--}}
{{--            <div class="tab-pane fade" id="nav-4-eg1" role="tabpanel" aria-labelledby="nav-4-eg1-tab">--}}
{{--                @include('Mobile.menu.modules.congregation.components.requests')--}}
{{--            </div>--}}
{{--            <div class="tab-pane fade" id="nav-5-eg1" role="tabpanel" aria-labelledby="nav-5-eg1-tab">--}}
{{--                @include('Mobile.menu.modules.congregation.components.modules')--}}
{{--            </div>--}}
{{--        </div>--}}


    </div>


@endsection
