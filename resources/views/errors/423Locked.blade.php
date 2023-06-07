@extends('layouts.error')
@section('title')Stand | Error 423 @endsection
@section('content')
        <div class="not-found-wrap text-center">
        <h1 class="text-60">423</h1>
        <p class="text-36 subheading mb-3 text-danger">Защищено</p>
        <p class="mb-5 text-muted text-20 ">Для того чтобы попасть на эту страницу необходимы права доступа, обратитесь к администратору за информацией!</p><a class="btn btn-lg btn-primary btn-rounded" href="{{ URL::previous() }}">Вернуться назад</a>
    </div>
@endsection
