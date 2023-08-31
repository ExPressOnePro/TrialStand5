@extends('layouts.error')
@section('title') Stand | нет прав @endsection
@section('content')

    <div class="not-found-wrap text-center">
            <h1 class="text-60">423</h1>
            <p class="text-36 subheading mb-3 text-danger">
                <i class="fa-solid fa-lock"></i>
            </p>
            <p class="mb-5 text-muted text-20 ">Для того чтобы попасть на эту страницу необходимы права доступа, обратитесь к администратору за информацией!</p>
            <a class="btn btn-lg btn-primary btn-rounded" href="{{ URL::previous() }}">Вернуться назад</a>
    </div>

    <div class="content container-fluid">
        <div class="row justify-content-center align-items-sm-center py-sm-10">
            <div class="col-9 col-sm-6 col-lg-4">

            </div>
            <!-- End Col -->

            <div class="col-sm-6 col-lg-4 text-center text-sm-start">
                <h1 class="display-1 mb-0">404</h1>
                <p class="lead">Вы не имеете разрешения для открытия этой страницы</p>
                <a class="btn btn-primary" href="{{ URL::previous() }}">Вернуться назад</a>
            </div>
            <!-- End Col -->
        </div>
        <!-- End Row -->
    </div>
@endsection
