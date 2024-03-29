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
        <div class="row">
            <div class="col-md-6 mb-3 mb-lg-5">
                <div class="d-grid gap-2 gap-lg-4">
                    <a class="card card-hover-shadow border-secondary" href="{{ route('profile') }}">
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

{{--                    @can('module.report')--}}
{{--                    <a class="card card-hover-shadow" href="{{ route('profile.reports') }}">--}}
{{--                        <div class="card-body">--}}
{{--                            <div class="d-flex align-items-center">--}}
{{--                                <div class="flex-shrink-0">--}}
{{--                                </div>--}}

{{--                                <div class="flex-grow-1 ms-4">--}}
{{--                                    <h3 class="text-inherit mb-1">Мои отчеты</h3>--}}
{{--                                    <span class="text-body"></span>--}}
{{--                                </div>--}}

{{--                                <div class="ms-2 text-end">--}}
{{--                                    <i class="bi-chevron-right text-body text-inherit"></i>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </a>--}}
{{--                    @endcan--}}

                    <a class="card card-hover-shadow border-secondary" href="{{ route('profile.settings') }}">
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
                    @role('Developer')
                    <a class="card card-hover-shadow border-secondary" href="{{ route('profile') }}">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="flex-shrink-0">
                                </div>

                                <div class="flex-grow-1 ms-4">
                                    <h3 class="text-inherit mb-1">Помощь</h3>
                                    <span class="text-body">Часто задаваемые вопросы</span>
                                </div>

                                <div class="ms-2 text-end">
                                    <i class="bi-chevron-right text-body text-inherit"></i>
                                </div>
                            </div>
                        </div>
                    </a>
                    @endrole
{{--                    @can('congregation.open_congregation')--}}
{{--                        <a class="card card-hover-shadow h-100" href="{{ route('congregationView', ['id' =>auth()->user()->congregation_id ]) }}">--}}
{{--                            <div class="card-body">--}}
{{--                                <div class="d-flex align-items-center">--}}
{{--                                    <div class="flex-shrink-0">--}}
{{--                                    </div>--}}

{{--                                    <div class="flex-grow-1 ms-4">--}}
{{--                                        <h3 class="text-inherit mb-1">Собрание</h3>--}}
{{--                                        <span class="text-body"> Управляйте собранием</span>--}}
{{--                                    </div>--}}

{{--                                    <div class="ms-2 text-end">--}}
{{--                                        <i class="bi-chevron-right text-body text-inherit"></i>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </a>--}}
{{--                    @endcan--}}
{{--                    @can('module.schedule')--}}
{{--                        <a class="card card-hover-shadow" href="{{ route('meetingSchedules.overview') }}">--}}
{{--                        <div class="card-body">--}}
{{--                            <div class="d-flex align-items-center">--}}
{{--                                <div class="flex-shrink-0">--}}
{{--                                </div>--}}

{{--                                <div class="flex-grow-1 ms-4">--}}
{{--                                    <h3 class="text-inherit mb-1">meetingSchedules</h3>--}}
{{--                                    <span class="text-body"></span>--}}
{{--                                </div>--}}

{{--                                <div class="ms-2 text-end">--}}
{{--                                    <i class="bi-chevron-right text-body text-inherit"></i>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </a>--}}
{{--                    @endcan--}}
                </div>
            </div>
        </div>


    <div class="footer mb-7">
        <div class="row justify-content-between align-items-center">
            <div class="col">
                <a class="btn btn-outline-primary btn-sm" href="https://t.me/meeper_support">
                    <i class="fa-solid fa-headset"><span> Поддержка </span></i>
                </a>
            </div>
            <div class="col-auto">
                <div class="d-flex justify-content-between">
                    <a class="btn btn-outline-secondary border-secondary btn-sm" href="{{route('changeLog')}}">
                        <i class="bi-box-arrow-up-right ms-1"><span>Версия и обновления</span></i>
                    </a>
                </div>
            </div>

        </div>
    </div>
@endsection
