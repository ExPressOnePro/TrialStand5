@extends('layouts.app')
@section('title')Stand | Стенды@endsection
@section('content')


    <div class="not-found-wrap text-center">
        <h1 class="text-60"></h1>
        <p class="text-36 subheading mb-3 text-danger">Уведомление</p>
        <p class="mb-5 text-muted text-20">Для того чтобы увидеть доступные стенды вашему собранию сообщите нижнее число ответственному!<h1 class="header ">{{ Auth::id()}}</h1></p>
        <a class="btn btn-lg btn-primary btn-rounded" href="{{ URL::previous() }}">Вернуться назад</a>
    </div>

@endsection
