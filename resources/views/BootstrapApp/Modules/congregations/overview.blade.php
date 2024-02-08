@extends('BootstrapApp.layouts.bootstrapApp')
@section('title') Meeper @endsection
@section('content')

    <div class="content container-fluid">
        @include('BootstrapApp.includes.alerts')
        <div class="row">
            <aside class="col-lg-2 d-none d-lg-block sticky-xl-top text-body-secondary align-self-start" style="top: 6rem;">
                <div class="bd-example m-0 border-0">
                    <div class="list-group">
                        <a href="{{ route('congregationView', $congregation->id) }}" class="list-group-item list-group-item-action"><strong class="mb-1">Обзор</strong></a>
                        <a href="{{ route('congregation.publishers', $congregation->id) }}" class="list-group-item list-group-item-action "><strong class="mb-1">Возвещатели</strong></a>
                        <a href="{{ route('congregation.modules', $congregation->id) }}" class="list-group-item list-group-item-action "><strong class="mb-1">Модули</strong></a>
                        <br>
                        @can('module.stand')
                        <a href="{{ route('congregation.stands', $congregation->id) }}" class="list-group-item list-group-item-action "><strong class="mb-1">Стенд</strong></a>
                        @endcan
                        @can('module.contacts')
                            <a href="{{ route('contacts.hub2', $congregation->id) }}" class="list-group-item list-group-item-action "><strong class="mb-1">Контакты</strong></a>
                        @endcan
                        @can('module.schedule')
                            <a href="{{ route('meetingSchedules.overview', $congregation->id) }}" class="list-group-item list-group-item-action "><strong class="mb-1">Расписания</strong></a>
                        @endcan
                        <br>
                        <a href="#" class="list-group-item list-group-item-action  list-group-item-secondary"> <strong class="mb-1">Настройки</strong></a>
                    </div>
                </div>
            </aside>

            <div class="col-lg-10 col-md-12 col-sm-12">

                <div id="preloader" class="text-center" style="display: none;">
                    <div class="spinner-border" style="width: 3rem; height: 3rem;" role="status">
                        <span class="sr-only">...</span>
                    </div>
                </div>
{{--        <div class="row">--}}
{{--            <div class="col d-flex justify-content-between">--}}
{{--                <p class="h4">{{$congregation->name}}</p>--}}
{{--                <a class="text-dark text-decoration-none btn btn-outline-secondary h4" href="{{route('congregation.settings', $congregation->id)}}">--}}
{{--                    <i class="bi bi-gear text-dark"></i>--}}
{{--                </a>--}}
{{--            </div>--}}
{{--        </div>--}}

        @if(Request::is('*congregation/overview/*'))
            <div id="dynamic-content-overview"></div>
            <script>
                $(document).ready(function () {

                    loadDynamicContent('menu');
                });

                function loadDynamicContent(page) {
                    $('#preloader').show();
                    $.ajax({
                        url: "{{ route('overviewAj', $congregation->id) }}",
                        type: "GET",
                        success: function (data) {
                            $('#preloader').hide();
                            $('#dynamic-content-overview').html(data);
                        },
                        error: function (error) {
                            $('#preloader').hide();
                            console.error(error);
                        }
                    });
                }
            </script>
        @elseif(Request::is('*congregation/publishers/*'))
            <div id="dynamic-content-publishers"></div>
            <script>
                $(document).ready(function () {
                    loadDynamicContent('menu');
                });

                function loadDynamicContent(page) {
                    $('#preloader').show();
                    $.ajax({
                        url: "{{ route('congregation.publishersAj', $congregation->id) }}",
                        type: "GET",
                        success: function (data) {
                            $('#preloader').hide();
                            $('#dynamic-content-publishers').html(data);
                        },
                        error: function (error) {
                            $('#preloader').hide();
                            console.error(error);
                        }
                    });
                }
            </script>
        @elseif(Request::is('*congregation/settings/*'))
            <div id="dynamic-content-overview"></div>
            <script>
                $(document).ready(function () {

                    loadDynamicContent('menu');
                });

                function loadDynamicContent(page) {
                    $('#preloader').show();
                    $.ajax({
                        url: "{{ route('congregation.settingsAj', $congregation->id) }}",
                        type: "GET",
                        success: function (data) {
                            $('#preloader').hide();
                            $('#dynamic-content-overview').html(data);
                        },
                        error: function (error) {
                            $('#preloader').hide();
                            console.error(error);
                        }
                    });
                }
            </script>
        @elseif(Request::is('*congregation/createUser/*'))
            <div id="dynamic-content-createUser"></div>
            <script>
                $(document).ready(function () {

                    loadDynamicContent('menu');
                });

                function loadDynamicContent(page) {
                    $('#preloader').show();
                    $.ajax({
                        url: "{{ route('congregation.createUserAj', $congregation->id) }}",
                        type: "GET",
                        success: function (data) {
                            $('#preloader').hide();
                            $('#dynamic-content-createUser').html(data);
                        },
                        error: function (error) {
                            $('#preloader').hide();
                            console.error(error);
                        }
                    });
                }
            </script>
                @elseif(Request::is('*congregation/stands/*'))
                    <div id="dynamic-content-stands"></div>
                    <script>
                        $(document).ready(function () {

                            loadDynamicContent('menu');
                        });

                        function loadDynamicContent(page) {
                            $('#preloader').show();
                            $.ajax({
                                url: "{{ route('congregation.standsAj', $congregation->id) }}",
                                type: "GET",
                                success: function (data) {
                                    $('#preloader').hide();
                                    $('#dynamic-content-stands').html(data);
                                },
                                error: function (error) {
                                    $('#preloader').hide();
                                    console.error(error);
                                }
                            });
                        }
                    </script>
                @elseif(Request::is('*congregation/modules/*'))
                    <div id="dynamic-content-modules"></div>
                    <script>
                        $(document).ready(function () {

                            loadDynamicContent('menu');
                        });

                        function loadDynamicContent(page) {
                            $('#preloader').show();
                            $.ajax({
                                url: "{{ route('congregation.modulesAj', $congregation->id) }}",
                                type: "GET",
                                success: function (data) {
                                    $('#preloader').hide();
                                    $('#dynamic-content-modules').html(data);
                                },
                                error: function (error) {
                                    $('#preloader').hide();
                                    console.error(error);
                                }
                            });
                        }
                    </script>
        @endif
    </div>
        </div>
    </div>


@endsection
