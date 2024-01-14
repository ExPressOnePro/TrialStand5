@extends('BootstrapApp.layouts.bootstrapApp')
@section('title') Meeper  @endsection
@section('content')
{{--    @include('Mobile.includes.headers.header-profile')--}}

    <div class="content container-fluid mt-7">
        <!-- Page Header -->
        @include('Mobile.includes.alerts.alerts')

        <div class="page-header">
            <div class="row align-items-end">
                <div class="col-sm mb-2 mb-sm-0">
                    <h1 class="page-header-title">Настройки аккаунта</h1>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-6 d-flex justify-content-between mb-2">
                <div id="content" class="card">
                    @include('Mobile.profile.settings.basicInformation')
                </div>
            </div>
            @can('module.stand')
            <div class="col-lg-6 d-flex justify-content-between mb-2">
                <div id="standShow" class="card">
                    @include('Mobile.profile.settings.standShow')
                </div>
            </div>
            @endcan
            <div class="col-lg-6 d-flex justify-content-between mb-5">
                    <div id="contactsSection" class="card">
                        @include('Mobile.profile.settings.contactsSection')
                    </div>
            </div>
                <div class="col-lg-6 d-flex justify-content-between mb-5">
                    <div id="emailSection" class="card">
                        @include('Mobile.profile.settings.emailSection')
                    </div>
                </div>
                    <div class="col-lg-6 d-flex justify-content-between mb-5">
                    <div id="passwordSection" class="card">
                        @include('Mobile.profile.settings.passwordSection')
                    </div>
                    </div>

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
        </div>
    </div>

@endsection
