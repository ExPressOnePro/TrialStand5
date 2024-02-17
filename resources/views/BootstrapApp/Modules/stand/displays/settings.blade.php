@extends('BootstrapApp.layouts.app')
@section('title')
    Meeper
@endsection
@section('content')

    <div class="content container-fluid mt-8">
        @include('Mobile.includes.alerts.alerts')
        <div class="row">
            <div class="col-lg-12s mb-4">
                <div class="row">

                    <div class="col-lg-12 mb-4">
                        <div id="content" class="card">
                            <a class="btn btn-outline-primary" href="{{ route('permUserStand',$stand->id) }}"> Права
                                Пользователей стенда </a>
                        </div>
                    </div>
                    <div class="col-lg-4 mb-4">
                        <div id="content" class="card">
                            {{--                            @include('Mobile.menu.modules.stand.components.default')--}}
                            @include('BootstrapApp.Modules.stand.components.stand_settings')
                        </div>
                    </div>
                    <div class="col-lg-4 mb-4">
                        <div id="content" class="card">
                            @include('BootstrapApp.Modules.stand.components.publishersAtStandSection')
                            {{--                            @include('Mobile.menu.modules.stand.components.publishersAtStandSection')--}}
                        </div>
                    </div>
                    <div class="col-lg-4 mb-4">
                        <div id="emailSection" class="card">
                            {{--                            @include('Mobile.menu.modules.stand.components.activationNextWeekSection')--}}
                            @include('BootstrapApp.Modules.stand.components.activationNextWeekSection')
                        </div>
                    </div>
                    {{--                    <div class="col-12 mb-4">--}}
                    {{--                        <div id="themeAccountsSection" class="card">--}}
                    {{--                            @include('Mobile.menu.modules.stand.components.recordingTimeSection')--}}
                    {{--                        </div>--}}
                    {{--                    </div>--}}
                    <div class="col-12 mb-4">
                        <div id="themeAccountsSection" class="card">
                            {{--                            @include('Mobile.menu.modules.stand.components.activeTime')--}}
                            @include('BootstrapApp.Modules.stand.components.activeTime')
                        </div>
                    </div>
                </div>
            </div>


        </div>
    </div>
    </div>

@endsection
