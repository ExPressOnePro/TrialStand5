@extends('layouts.error')
@section('title')Stand | Error 401 @endsection
@section('content')
        <div class="not-found-wrap text-center">
        <h1 class="text-60">401</h1>
        <p class="text-36 subheading mb-3">Ошибка!</p>
        <p class="mb-5 text-muted text-18">Извините! необходимо пройти повторную авторизацию</p><a class="btn btn-lg btn-primary btn-rounded" href="/">Авторизация</a>
    </div>
@endsection
