@extends('Mobile.layouts.front.profile')
@section('title') Meeper | Мой аккаунт @endsection
@section('content')
    @include('Mobile.includes.headers.header-profile')
    @include('Mobile.includes.alerts.alerts')

    <div class="content container-fluid">

        <div class="page-header page-header-reset">
            <div class="row align-items-center">
                <div class="col-sm">
                    <h2 class="page-header-title">Управление аккаунтом</h2>
                </div>
            </div>
        </div>

        <a class="btn btn-outline-primary" href="{{route('generateToken', Auth::id())}}">API Token</a>
        <a class="btn btn-outline-primary" href="{{route('info')}}">Test info</a>

        <div class="row">
            <div class="col-md-6 mb-3 mb-lg-5">
                <div class="d-grid gap-2 gap-lg-4">

                    <a class="card card-hover-shadow" href="{{ route('profile') }}">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="flex-shrink-0">
                                </div>

                                <div class="flex-grow-1 ms-4">
                                    <h3 class="text-inherit mb-1">Мой профиль</h3>
                                    <span class="text-body"></span>
                                </div>

                                <div class="ms-2 text-end">
                                    <i class="bi-chevron-right text-body text-inherit"></i>
                                </div>
                            </div>
                        </div>
                    </a>

                    <a class="card card-hover-shadow" href="{{ route('profile.reports') }}">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="flex-shrink-0">
                                </div>

                                <div class="flex-grow-1 ms-4">
                                    <h3 class="text-inherit mb-1">Мои отчеты</h3>
                                    <span class="text-body"></span>
                                </div>

                                <div class="ms-2 text-end">
                                    <i class="bi-chevron-right text-body text-inherit"></i>
                                </div>
                            </div>
                        </div>
                    </a>

                    <a class="card card-hover-shadow" href="{{ route('profile.settings') }}">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="flex-shrink-0">
                                </div>

                                <div class="flex-grow-1 ms-4">
                                    <h3 class="text-inherit mb-1">Настройки</h3>
                                    <span class="text-body"></span>
                                </div>

                                <div class="ms-2 text-end">
                                    <i class="bi-chevron-right text-body text-inherit"></i>
                                </div>
                            </div>
                        </div>
                    </a>

                    @can('congregation.open_congregation')
                        <a class="card card-hover-shadow h-100" href="{{ route('congregationView', ['id' =>auth()->user()->congregation_id ]) }}">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div class="flex-shrink-0">
                                    </div>

                                    <div class="flex-grow-1 ms-4">
                                        <h3 class="text-inherit mb-1">Собрание</h3>
                                        <span class="text-body"> Управляйте собранием</span>
                                    </div>

                                    <div class="ms-2 text-end">
                                        <i class="bi-chevron-right text-body text-inherit"></i>
                                    </div>
                                </div>
                            </div>
                        </a>
                    @endcan
                    @can('module.schedule')
                        <a class="card card-hover-shadow" href="{{ route('meetingSchedules.overview') }}">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="flex-shrink-0">
                                </div>

                                <div class="flex-grow-1 ms-4">
                                    <h3 class="text-inherit mb-1">Настройки</h3>
                                    <span class="text-body"></span>
                                </div>

                                <div class="ms-2 text-end">
                                    <i class="bi-chevron-right text-body text-inherit"></i>
                                </div>
                            </div>
                        </div>
                    </a>
                    @endcan
                </div>
            </div>
        </div>
    </div>

@endsection
