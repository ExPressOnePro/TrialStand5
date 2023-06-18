@extends('layouts.error')
@section('title')Stand | Error 401 @endsection
@section('content')
        <div class="not-found-wrap text-center">
        <h1 class="text-60"></h1>
        <p class="text-36 subheading mb-3">Ваш сеанс был окончен!</p>
        <p class="mb-5 text-muted text-18">Необходимо пройти повторную авторизацию</p><a class="btn btn-lg btn-primary btn-rounded" href="/">Авторизация</a>
    </div>
@endsection
