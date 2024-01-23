@extends('BootstrapApp.layouts.bootstrapApp')
@section('title') Meeper @endsection
@section('content')
    <div class="content container-fluid">

        <div class="row">
            <aside class="col-lg-2 d-none d-lg-block sticky-xl-top text-body-secondary align-self-start" style="top: 6rem;">
                <div class="list-group list-group-flush rounded-2">
                    <a href="{{ route('congregationView', $congregation->id) }}" class="list-group-item list-group-item-action lh-sm mb-1 shadow-sm" aria-current="true">
                        <div class="d-flex w-100 align-items-center justify-content-between">
                            <strong class="mb-1">Обзор</strong>
                        </div>
                    </a>
                    <a href="{{ route('congregation.publishers', $congregation->id) }}" class="list-group-item list-group-item-action lh-sm mb-1 shadow-sm" aria-current="true">
                        <div class="d-flex w-100 align-items-center justify-content-between">
                            <strong class="mb-1">Возвещатели</strong>
                        </div>
                    </a>
                    <a href="{{ route('congregation.stands', $congregation->id) }}" class="list-group-item list-group-item-action lh-sm mb-1 shadow-sm" aria-current="true">
                        <div class="d-flex w-100 align-items-center justify-content-between">
                            <strong class="mb-1">Стенд (ы)</strong>
                        </div>
                    </a>
                    <a href="{{ route('meetingSchedules.overview', $congregation->id) }}" class="list-group-item list-group-item-action lh-sm mb-1 shadow-sm" aria-current="true">
                        <div class="d-flex w-100 align-items-center justify-content-between">
                            <strong class="mb-1">Расписание встреч</strong>
                        </div>
                    </a>
                    <a href="{{ route('congregation.modules', $congregation->id) }}" class="list-group-item list-group-item-action lh-sm mb-1 shadow-sm" aria-current="true">
                        <div class="d-flex w-100 align-items-center justify-content-between">
                            <strong class="mb-1">Модули</strong>
                        </div>
                    </a>
                    <a href="#" class="list-group-item list-group-item-action lh-sm mb-1 shadow-sm" aria-current="true">
                        <div class="d-flex w-100 align-items-center justify-content-between">
                            <strong class="mb-1">Настройки</strong>
                        </div>
                    </a>
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
        @endif
    </div>
        </div>
    </div>


@endsection
