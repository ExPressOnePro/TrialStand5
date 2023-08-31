@extends('Mobile.layouts.front.profile')
@section('title') Meeper | Мой аккаунт @endsection
@section('content')
    @include('Mobile.includes.headers.header-profile')

    <div class="content container-fluid mt-7">
        <!-- Page Header -->
        @include('Mobile.includes.alerts.alerts')

        <div class="page-header">
            <div class="row align-items-end">
                <div class="col-sm mb-2 mb-sm-0">
                    <h1 class="page-header-title">Настройки аккаунта</h1>
                </div>
                <!-- End Col -->

                <div class="col-sm-auto">
                    <a class="btn btn-primary" href="{{route('profile')}}">
                        <i class="bi-person-fill me-1"></i> Мой профиль
                    </a>
                </div>
                <!-- End Col -->
            </div>
            <!-- End Row -->
        </div>
        <!-- End Page Header -->

        <div class="row">
            <div class="col-lg-3">
                <!-- Navbar -->
                <div class="navbar-expand-lg navbar-vertical mb-3 mb-lg-5">
                    <!-- Navbar Toggle -->
                    <!-- Navbar Toggle -->
                    <div class="d-grid">
                        <button type="button" class="navbar-toggler btn btn-white mb-3 collapsed rounded-2 border-primary" data-bs-toggle="collapse" data-bs-target="#navbarVerticalNavMenu" aria-label="Toggle navigation" aria-expanded="false" aria-controls="navbarVerticalNavMenu">
                <span class="d-flex justify-content-between align-items-center">
                  <span class="text-dark">Menu</span>

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
                    <div id="navbarVerticalNavMenu" class="navbar-collapse collapse border-primary" style="">
                        <ul id="navbarSettings" class="js-sticky-block js-scrollspy card card-navbar-nav nav nav-tabs nav-lg nav-vertical hs-kill-sticky border-primary" data-hs-sticky-block-options="{
                     &quot;parentSelector&quot;: &quot;#navbarVerticalNavMenu&quot;,
                     &quot;targetSelector&quot;: &quot;#header&quot;,
                     &quot;breakpoint&quot;: &quot;lg&quot;,
                     &quot;startPoint&quot;: &quot;#navbarVerticalNavMenu&quot;,
                     &quot;endPoint&quot;: &quot;#stickyBlockEndPoint&quot;,
                     &quot;stickyOffsetTop&quot;: 20
                   }">
                            <li class="nav-item">
                                <a class="nav-link" href="#content">
                                    <i class="bi-person nav-icon"></i> Основная информация
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#contactsSection">
                                    <i class="bi bi-link-45deg nav-icon"></i> Контакты
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#emailSection">
                                    <i class="bi-at nav-icon"></i> Email
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#passwordSection">
                                    <i class="bi-key nav-icon"></i> Смена пароля
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#themeAccountsSection">
                                    <i class="bi bi-droplet nav-icon"></i> Тема приложения
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


                    <div id="content" class="card">
                        @include('Mobile.profile.settings.basicInformation')
                    </div>


                    <div id="contactsSection" class="card">
                        @include('Mobile.profile.settings.contactsSection')
                    </div>

                    <div id="emailSection" class="card">
                        @include('Mobile.profile.settings.emailSection')
                    </div>
                    <div id="passwordSection" class="card">
                        @include('Mobile.profile.settings.passwordSection')
                    </div>

                    <!-- Card -->
                    <div id="themeAccountsSection" class="card">
                        @include('Mobile.profile.settings.themeAccountsSection')
                    </div>

                    <!-- End Card -->

{{--                    <!-- Card -->--}}
{{--                    <div id="deleteAccountSection" class="card">--}}
{{--                        <div class="card-header">--}}
{{--                            <h4 class="card-title">Delete your account</h4>--}}
{{--                        </div>--}}

{{--                        <!-- Body -->--}}
{{--                        <div class="card-body">--}}
{{--                            <p class="card-text">When you delete your account, you lose access to Front account services, and we permanently delete your personal data. You can cancel the deletion for 14 days.</p>--}}

{{--                            <div class="mb-4">--}}
{{--                                <!-- Form Check -->--}}
{{--                                <div class="form-check">--}}
{{--                                    <input class="form-check-input" type="checkbox" value="" id="deleteAccountCheckbox">--}}
{{--                                    <label class="form-check-label" for="deleteAccountCheckbox">--}}
{{--                                        Confirm that I want to delete my account.--}}
{{--                                    </label>--}}
{{--                                </div>--}}
{{--                                <!-- End Form Check -->--}}
{{--                            </div>--}}

{{--                            <div class="d-flex justify-content-end gap-3">--}}
{{--                                <a class="btn btn-white" href="#">Learn more</a>--}}
{{--                                <button type="submit" class="btn btn-danger">Delete</button>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <!-- End Body -->--}}
{{--                    </div>--}}
{{--                    <!-- End Card -->--}}
                </div>

                <!-- Sticky Block End Point -->
                <div id="stickyBlockEndPoint"></div>
            </div>
        </div>
    </div>

@endsection
