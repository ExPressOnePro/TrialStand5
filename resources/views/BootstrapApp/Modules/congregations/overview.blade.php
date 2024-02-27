@extends('BootstrapApp.layouts.app')
@section('title') Meeper @endsection
@section('content')

    <div class="content container-fluid">
        @include('BootstrapApp.includes.alerts')
        <div class="row">
            <aside class="col-lg-2 d-none d-lg-block sticky-xl-top text-body-secondary align-self-start" style="top: 6rem;">
                <div class="bd-example m-0 border-0">
                    <div class="list-group">
                        <button class="list-group-item list-group-item-action" onclick="loadContent('over')"><strong class="mb-1">Обзор</strong></button>
                        <button class="list-group-item list-group-item-action" onclick="loadContent('publishers')"><strong class="mb-1">Возвещатели</strong></button>
                        <button class="list-group-item list-group-item-action" onclick="loadContent('modules')"><strong class="mb-1">Модули</strong></button>
                        <br>
                        @can('module.stand')
                            <button class="list-group-item list-group-item-action" onclick="loadContent('stands')"><strong class="mb-1">Стенд</strong></button>
                        @endcan
                        @can('module.contacts')
                            <button class="list-group-item list-group-item-action" onclick="loadContent('contacts')"><strong class="mb-1">Контакты</strong></button>
                        @endcan
                        @can('module.schedule')
                            <button class="list-group-item list-group-item-action" onclick="loadContent('meetingSchedules')"><strong class="mb-1">Расписания</strong></button>
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
                <div id="content-container"></div>

                <script>
                    function loadContent(content, userId) {
                        $('#preloader').show();
                        var url = '{{ route('get-content', '') }}/' + content;
                        if (userId) {
                            url += '/' + userId;
                        }
                        window.history.pushState({ path: window.location.href }, '', `?content=${content}`);
                        localStorage.setItem('lastContent', content); // Сохраняем текущий content

                        $.ajax({
                            url: url,
                            type: 'GET',
                            success: function(response) {
                                $('#preloader').hide();
                                $('#content-container').html(response.content);
                                // Добавить текущее состояние в историю
                                historyStack.push({ content: content });
                            },
                            error: function(error) {
                                $('#preloader').hide();
                                console.error(error);
                            }
                        });
                    }


                    $(window).on('popstate', function(event) {
                        var url = new URL(window.location.href);
                        var content = url.searchParams.get("content");
                        if (content) {
                            loadContent(content, false);
                        }
                    });


                    $(document).ready(function() {
                        var lastContent = localStorage.getItem('lastContent');
                        var lastUserId = localStorage.getItem('lastUserId');

                        if (lastContent === 'personalInfo') {
                            loadContent('personalInfo', lastUserId);
                        }
                        if (lastContent) {
                            loadContent(lastContent);
                        } else {
                            loadContent('over'); // Загрузить по умолчанию, если нет сохраненного content
                        }
                    });

                    if (!url.searchParams.has('congregation*')) {
                        window.addEventListener('beforeunload', function (event) {
                            localStorage.removeItem('lastContent');
                        });
                    }


                    // $(document).ready(function() {
                    //     var lastUserId = localStorage.getItem('lastUserId');
                    //     if (lastUserId) {
                    //         loadContent('personalInfo', lastUserId);
                    //     }
                    // });

                </script>

{{--        <div class="row">--}}
{{--            <div class="col d-flex justify-content-between">--}}
{{--                <p class="h4">{{$congregation->name}}</p>--}}
{{--                <a class="text-dark text-decoration-none btn btn-outline-secondary h4" href="{{route('congregation.settings', $congregation->id)}}">--}}
{{--                    <i class="bi bi-gear text-dark"></i>--}}
{{--                </a>--}}
{{--            </div>--}}
{{--        </div>--}}

{{--        @if(Request::is('*congregation/overview/*'))--}}
{{--            <div id="dynamic-content-overview"></div>--}}
{{--            <script>--}}
{{--                $(document).ready(function () {--}}

{{--                    loadDynamicContent('menu');--}}
{{--                });--}}

{{--                function loadDynamicContent(page) {--}}
{{--                    $('#preloader').show();--}}
{{--                    $.ajax({--}}
{{--                        url: "{{ route('overviewAj', $congregation->id) }}",--}}
{{--                        type: "GET",--}}
{{--                        success: function (data) {--}}
{{--                            $('#preloader').hide();--}}
{{--                            $('#dynamic-content-overview').html(data);--}}
{{--                        },--}}
{{--                        error: function (error) {--}}
{{--                            $('#preloader').hide();--}}
{{--                            console.error(error);--}}
{{--                        }--}}
{{--                    });--}}
{{--                }--}}
{{--            </script>--}}
{{--        @elseif(Request::is('*congregation/publishers/*'))--}}
{{--            <div id="dynamic-content-publishers"></div>--}}
{{--            <script>--}}
{{--                $(document).ready(function () {--}}
{{--                    loadDynamicContent('menu');--}}
{{--                });--}}

{{--                function loadDynamicContent(page) {--}}
{{--                    $('#preloader').show();--}}
{{--                    $.ajax({--}}
{{--                        url: "{{ route('congregation.publishersAj', $congregation->id) }}",--}}
{{--                        type: "GET",--}}
{{--                        success: function (data) {--}}
{{--                            $('#preloader').hide();--}}
{{--                            $('#dynamic-content-publishers').html(data);--}}
{{--                        },--}}
{{--                        error: function (error) {--}}
{{--                            $('#preloader').hide();--}}
{{--                            console.error(error);--}}
{{--                        }--}}
{{--                    });--}}
{{--                }--}}
{{--            </script>--}}
{{--        @elseif(Request::is('*congregation/settings/*'))--}}
{{--            <div id="dynamic-content-overview"></div>--}}
{{--            <script>--}}
{{--                $(document).ready(function () {--}}

{{--                    loadDynamicContent('menu');--}}
{{--                });--}}

{{--                function loadDynamicContent(page) {--}}
{{--                    $('#preloader').show();--}}
{{--                    $.ajax({--}}
{{--                        url: "{{ route('congregation.settingsAj', $congregation->id) }}",--}}
{{--                        type: "GET",--}}
{{--                        success: function (data) {--}}
{{--                            $('#preloader').hide();--}}
{{--                            $('#dynamic-content-overview').html(data);--}}
{{--                        },--}}
{{--                        error: function (error) {--}}
{{--                            $('#preloader').hide();--}}
{{--                            console.error(error);--}}
{{--                        }--}}
{{--                    });--}}
{{--                }--}}
{{--            </script>--}}
{{--        @elseif(Request::is('*congregation/createUser/*'))--}}
{{--            <div id="dynamic-content-createUser"></div>--}}
{{--            <script>--}}
{{--                $(document).ready(function () {--}}

{{--                    loadDynamicContent('menu');--}}
{{--                });--}}

{{--                function loadDynamicContent(page) {--}}
{{--                    $('#preloader').show();--}}
{{--                    $.ajax({--}}
{{--                        url: "{{ route('congregation.createUserAj', $congregation->id) }}",--}}
{{--                        type: "GET",--}}
{{--                        success: function (data) {--}}
{{--                            $('#preloader').hide();--}}
{{--                            $('#dynamic-content-createUser').html(data);--}}
{{--                        },--}}
{{--                        error: function (error) {--}}
{{--                            $('#preloader').hide();--}}
{{--                            console.error(error);--}}
{{--                        }--}}
{{--                    });--}}
{{--                }--}}
{{--            </script>--}}
{{--                @elseif(Request::is('*congregation/stands/*'))--}}
{{--                    <div id="dynamic-content-stands"></div>--}}
{{--                    <script>--}}
{{--                        $(document).ready(function () {--}}

{{--                            loadDynamicContent('menu');--}}
{{--                        });--}}

{{--                        function loadDynamicContent(page) {--}}
{{--                            $('#preloader').show();--}}
{{--                            $.ajax({--}}
{{--                                url: "{{ route('congregation.standsAj', $congregation->id) }}",--}}
{{--                                type: "GET",--}}
{{--                                success: function (data) {--}}
{{--                                    $('#preloader').hide();--}}
{{--                                    $('#dynamic-content-stands').html(data);--}}
{{--                                },--}}
{{--                                error: function (error) {--}}
{{--                                    $('#preloader').hide();--}}
{{--                                    console.error(error);--}}
{{--                                }--}}
{{--                            });--}}
{{--                        }--}}
{{--                    </script>--}}
{{--                @elseif(Request::is('*congregation/personalInfo/*'))--}}
{{--                    <div id="dynamic-content-personalInfo"></div>--}}

{{--                    <script>--}}
{{--                        function loadDynamicContent(page) {--}}
{{--                            $('#preloader').show();--}}
{{--                            $.ajax({--}}
{{--                                url: "{{ route('congregation.personalInfoAj', ['id' => $congregation->id]) }}",--}}
{{--                                type: "GET",--}}
{{--                                success: function (data) {--}}
{{--                                    $('#preloader').hide();--}}
{{--                                    $('#dynamic-content-personalInfo').html(data);--}}
{{--                                },--}}
{{--                                error: function (error) {--}}
{{--                                    $('#preloader').hide();--}}
{{--                                    console.error(error);--}}
{{--                                }--}}
{{--                            });--}}
{{--                        }--}}
{{--                    </script>--}}
{{--                @elseif(Request::is('*congregation/modules/*'))--}}
{{--                    <div id="dynamic-content-modules"></div>--}}
{{--                    <script>--}}
{{--                        $(document).ready(function () {--}}

{{--                            loadDynamicContent('menu');--}}
{{--                        });--}}

{{--                        function loadDynamicContent(page) {--}}
{{--                            $('#preloader').show();--}}
{{--                            $.ajax({--}}
{{--                                url: "{{ route('congregation.modulesAj', $congregation->id) }}",--}}
{{--                                type: "GET",--}}
{{--                                success: function (data) {--}}
{{--                                    $('#preloader').hide();--}}
{{--                                    $('#dynamic-content-modules').html(data);--}}
{{--                                },--}}
{{--                                error: function (error) {--}}
{{--                                    $('#preloader').hide();--}}
{{--                                    console.error(error);--}}
{{--                                }--}}
{{--                            });--}}
{{--                        }--}}
{{--                    </script>--}}
{{--        @endif--}}
    </div>
        </div>
    </div>


@endsection
