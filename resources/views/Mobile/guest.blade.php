@extends('Mobile.layouts.front.auth')
@section('title') Meeper | Гость @endsection
@section('content')

    <div class="content container-fluid">
        <div class="heading text-center">
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                <span class="fw-semibold">Информация!</span> Для того чтобы увидеть доступы необходимо присоединиться к одному из списка
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @foreach($congregations as $congregation)
            <div class="card card-body border-secondary mt-2">
                <div class="row justify-content-between align-items-center">
                    <div class="col-6 py-1">
                        <span class="d-block h2 text-inherit mb-0">{{$congregation->name}}</span>
                    </div>

                    <div class="col-6 py-1">
                        <form method="POST" action="{{ route('joinCongregation', $congregation->id) }}">
                            @csrf
                                @if(DB::table('congregation_requests')
                                ->where('user_id', '=', Auth::id())
                                ->where('congregation_id', '=', $congregation->id)
                                ->count() > 0)
                                    <span class="text-success">
                                        <i class="fa-solid fa-circle-check"></i>
                                        Запрос отправлен
                                    </span>
                                @else
                                <button class="btn btn-primary">Присоединиться</button>
                                @endif
                        </form>
                    </div>
                </div>
            </div>
            @endforeach

        </div>
        {{--<div class="text-center mt-4">
            <a class="btn btn-lg btn-outline-primary btn-rounded " href="{{ URL::previous() }}">Вернуться назад</a>
        </div>--}}
    </div>
@endsection
@include('Mobile.includes.menuBarPhone')
