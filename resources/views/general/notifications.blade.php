@extends('layouts.app')
@section('title')Stand | Гость@endsection
@section('content')

    <div class="not-found-wrap text-center">
        <h1 class="text-60"></h1>
        <p class="text-36 subheading mb-3 text-danger">Страница Уведомлений</p>
        <p class="mb-5 text-muted text-20"><h1 class="header ">в разработке</h1></p>
        <a class="btn btn-lg btn-primary btn-rounded" href="{{ URL::previous() }}">Вернуться назад</a>
    </div>

@endsection
