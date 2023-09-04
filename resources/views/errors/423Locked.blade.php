@extends('Mobile.layouts.front.app')
@section('title') Stand | нет прав @endsection
@section('content')

    <div class="content container-fluid">
        <div class="row justify-content-center align-items-sm-center py-sm-10">
            <div class="col-9 col-sm-6 col-lg-4">

            </div>
            <!-- End Col -->

            <div class="col-sm-6 col-lg-4 text-center text-sm-start">
                <p class="lead">Вы не имеете разрешения для открытия этой страницы</p>
                <a class="btn btn-primary" onclick="goBack()">Вернуться назад</a>
            </div>
            <!-- End Col -->
        </div>
        <!-- End Row -->
    </div>


    <script>
        function goBack() {
            window.history.back();
        }
    </script>


@endsection
