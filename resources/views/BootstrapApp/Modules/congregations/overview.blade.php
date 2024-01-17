@extends('BootstrapApp.layouts.bootstrapApp')
@section('title') Meeper @endsection
@section('content')
    <div class="content container-fluid">
        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
            <div class="col">
                <div class="card shadow-sm">
                    <div id="myCarousel" class="carousel slide mb-6" width="100%" height="225" data-bs-ride="carousel">
                            <div class="carousel-indicators">
                                <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                                <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="1" aria-label="Slide 2"></button>
                                <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="2" aria-label="Slide 3"></button>
                            </div>
                            <div class="carousel-inner">
                                <div class="carousel-item active">
                                    <svg class="bd-placeholder-img" width="100%" height="100%" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" preserveAspectRatio="xMidYMid slice" focusable="false"><rect width="100%" height="100%" fill="var(--bs-secondary-color)"></rect></svg>
                                    <div class="container">
                                        <div class="carousel-caption text-start">
                                            <h1>Example headline.</h1>
                                            <p class="opacity-75">Some representative placeholder content for the first slide of the carousel.</p>
                                            <p><a class="btn btn-lg btn-primary" href="#">Sign up today</a></p>
                                        </div>
                                    </div>
                                </div>
                                <div class="carousel-item">
                                    <svg class="bd-placeholder-img" width="100%" height="100%" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" preserveAspectRatio="xMidYMid slice" focusable="false"><rect width="100%" height="100%" fill="var(--bs-secondary-color)"></rect></svg>
                                    <div class="container">
                                        <div class="carousel-caption">
                                            <h1>Another example headline.</h1>
                                            <p>Some representative placeholder content for the second slide of the carousel.</p>
                                            <p><a class="btn btn-lg btn-primary" href="#">Learn more</a></p>
                                        </div>
                                    </div>
                                </div>
                                <div class="carousel-item">
                                    <svg class="bd-placeholder-img" width="100%" height="100%" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" preserveAspectRatio="xMidYMid slice" focusable="false"><rect width="100%" height="100%" fill="var(--bs-secondary-color)"></rect></svg>
                                    <div class="container">
                                        <div class="carousel-caption text-end">
                                            <h1>One more for good measure.</h1>
                                            <p>Some representative placeholder content for the third slide of this carousel.</p>
                                            <p><a class="btn btn-lg btn-primary" href="#">Browse gallery</a></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <button class="carousel-control-prev" type="button" data-bs-target="#myCarousel" data-bs-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Previous</span>
                            </button>
                            <button class="carousel-control-next" type="button" data-bs-target="#myCarousel" data-bs-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Next</span>
                            </button>
                        </div>
                    <div class="card-body">
                        <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="btn-group">
                                <button type="button" class="btn btn-sm btn-outline-secondary">View</button>
                                <button type="button" class="btn btn-sm btn-outline-secondary">Edit</button>
                            </div>
                            <small class="text-body-secondary">9 mins</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <aside class="col-lg-2 d-none d-lg-block sticky-xl-top text-body-secondary align-self-start" style="top: 6rem;">
                <div class="list-group list-group-flush rounded-2">
                    <a href="#" class="list-group-item list-group-item-action lh-sm mb-1 shadow-sm" aria-current="true">
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
