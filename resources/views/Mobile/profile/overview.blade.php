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
        <div class="row justify-content-between align-items-center">
            <div class="col">

            </div>
            <!-- End Col -->

            <div class="col-auto">
                <div class="d-flex justify-content-end">
                    <!-- List Separator -->
                    <ul class="list-inline-item">
                        <li class="list-inline-item">
                            <i class="bi bi-telegram"><span> Связь с поддержкой в Telegram </span></i>
                        </li>


                        <li class="list-inline-item">
                            <!-- Keyboard Shortcuts Toggle -->
                            <a type="button" class="btn btn-outline-primary btn-icon btn-lg" href="https://t.me/meeper_support">
                                <i class="fa-solid fa-headset"></i>
                            </a>
                            <!-- End Keyboard Shortcuts Toggle -->
                        </li>
                    </ul>
                    <!-- End List Separator -->
                </div>
            </div>
            <!-- End Col -->
        </div>
    </div>

    <div class="footer mb-7">
        <div class="row justify-content-between align-items-center">
            <div class="col">
                <p class="fs-6 mb-0">© Front. <span class="d-none d-sm-inline-block">2022 Htmlstream.</span></p>
            </div>
            <!-- End Col -->
            <div class="col-auto">
                <div class="d-flex justify-content-end">
                    <!-- List Separator -->
                    <ul class="list-inline list-separator">

                        <li class="list-inline-item">
                            Что нового
                            <button class="btn btn-ghost-secondary btn btn-icon btn-ghost-secondary rounded-circle" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasKeyboardShortcuts" aria-controls="offcanvasKeyboardShortcuts">
                                <i class="bi bi-arrow-clockwise"></i>
                            </button>
                            <!-- End Keyboard Shortcuts Toggle -->
                        </li>
                    </ul>
                    <!-- End List Separator -->
                </div>
            </div>
            <!-- End Col -->
        </div>
        <!-- End Row -->
    </div>
@endsection
