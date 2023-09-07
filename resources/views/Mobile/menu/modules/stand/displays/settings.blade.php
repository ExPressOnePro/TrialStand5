@extends('Mobile.layouts.front.profile')
@section('title')
    Meeper | Мой аккаунт
@endsection
@section('content')
    @include('Mobile.includes.headers.header-stand')
    @include('Mobile.includes.alerts.alerts')

    <div class="content container-fluid mt-8">

        <div class="row">
            <div class="col-lg-3">
                <!-- Navbar -->
                <div class="navbar-expand-lg navbar-vertical mb-3 mb-lg-5">
                    <!-- Navbar Toggle -->
                    <!-- Navbar Toggle -->
                    <div class="d-grid">
                        <button type="button" class="navbar-toggler btn btn-white mb-3 collapsed"
                                data-bs-toggle="collapse" data-bs-target="#navbarVerticalNavMenu"
                                aria-label="Toggle navigation" aria-expanded="false"
                                aria-controls="navbarVerticalNavMenu">
                            <span class="d-flex justify-content-between align-items-center">
                              <span class="text-dark">Меню</span>

                              <span class="navbar-toggler-default">
                                <i class="bi-list"></i>
                              </span>

                              <span class="navbar-toggler-toggled">
                                <i class="bi-x"></i>
                              </span>
                            </span>
                        </button>
                    </div>
                    <!-- End Navbar Toggle -->
                    <!-- End Navbar Toggle -->

                    <!-- Navbar Collapse -->
                    <div id="navbarVerticalNavMenu" class="navbar-collapse collapse" style="">
                        <ul id="navbarSettings"
                            class="js-sticky-block js-scrollspy card card-navbar-nav nav nav-tabs nav-lg nav-vertical hs-kill-sticky"
                            data-hs-sticky-block-options="{
                     &quot;parentSelector&quot;: &quot;#navbarVerticalNavMenu&quot;,
                     &quot;targetSelector&quot;: &quot;#header&quot;,
                     &quot;breakpoint&quot;: &quot;lg&quot;,
                     &quot;startPoint&quot;: &quot;#navbarVerticalNavMenu&quot;,
                     &quot;endPoint&quot;: &quot;#stickyBlockEndPoint&quot;,
                     &quot;stickyOffsetTop&quot;: 20
                   }">
                            <li class="nav-item">
                                <a class="nav-link" href="#content">
                                    <i class="bi-person nav-icon"></i> Возвещатели
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#emailSection">
                                    <i class="bi-at nav-icon"></i> Активация
                                </a>
                            </li>
                            {{--                            <li class="nav-item">--}}
                            {{--                                <a class="nav-link" href="#passwordSection">--}}
                            {{--                                    <i class="bi-key nav-icon"></i> Password--}}
                            {{--                                </a>--}}
                            {{--                            </li>--}}
                            <li class="nav-item">
                                <a class="nav-link" href="#themeAccountsSection">
                                    <i class="bi-instagram nav-icon"></i> Активное время
                                </a>
                            </li>
                            {{--                            <li class="nav-item">--}}
                            {{--                                <a class="nav-link" href="#deleteAccountSection">--}}
                            {{--                                    <i class="bi-trash nav-icon"></i> Delete account--}}
                            {{--                                </a>--}}
                            {{--                            </li>--}}
                        </ul>
                    </div>
                    <!-- End Navbar Collapse -->
                </div>
                <!-- End Navbar -->
            </div>

            <div class="col-lg-9">
                <div class="d-grid gap-3 gap-lg-5">

                    <a class="btn btn-outline-primary" href="{{ route('permUserStand') }}"> Права Пользователей стенда </a>
{{--                    <div id="content" class="card">--}}
{{--                        @include('Mobile.menu.modules.stand.components.permissionsPublishersPart2')--}}
{{--                    </div>--}}

                    <div id="content" class="card">
                        @include('Mobile.menu.modules.stand.components.publishersAtStandSection')
                    </div>

                    <div id="emailSection" class="card">
                        @include('Mobile.menu.modules.stand.components.activationNextWeekSection')
                    </div>

                    <div id="themeAccountsSection" class="card">
                        @include('Mobile.menu.modules.stand.components.recordingTimeSection')
                    </div>
                </div>

                <!-- Sticky Block End Point -->
                <div id="stickyBlockEndPoint"></div>
            </div>
        </div>
    </div>

@endsection
