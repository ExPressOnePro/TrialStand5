@extends('BootstrapApp.layouts.bootstrapApp')
@section('title')
    Meeper
@endsection
@section('content')
    <div class="content container-fluid">

        <div id="preloader" class="text-center" style="display: none;">
            <div class="spinner-border" style="width: 3rem; height: 3rem;" role="status">
                <span class="sr-only">...</span>
            </div>
        </div>
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


@endsection
