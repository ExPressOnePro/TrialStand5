@extends('layouts.app')
@section('title') Meeper | Гость @endsection
@section('content')
    <div class="main-content pt-2">
        <div class="heading text-center">
            <h1 class="text-60"></h1>
            <p class="text-36 subheading mb-3 text-danger">Уведомление</p>
            <p class="mb-5 text-muted text-20">Для того чтобы увидеть доступы необходимо присоединиться к одному из списка<h1 class="header "></h1>
            </p>
            <div class="row">
                <div class="col-md-4 mb-3"></div>
                <div class="col-md-4 mb-3">
                    {{--<div class="card mb-3">--}}
                    {{--<div class="card-body">--}}
                    <div class="separator-breadcrumb border-top"></div>
                    @foreach($congregation as $con)
                        <form method="POST" action="{{ route('joinCongregation', $con->id) }}">
                            @csrf
                            <div class="d-flex border-bottom justify-content-between mt-3">
                                <div class="flex-grow-1 text-left">
                                    <h4 class="heading">
                                        {{$con->name}}
                                    </h4>
                                </div>
                                @if(DB::table('congregation_requests')
                                ->where('user_id', '=', Auth::id())
                                ->where('congregation_id', '=', $con->id)
                                ->count() > 0)
                                    <div class="flex-grow-1 text-right ml-0">
                                    <span class="text-success">
                                        <i class="fa-solid fa-circle-check"></i>
                                        Запрос отправлен
                                    </span>
                                    </div>
                                @else
                                    <div class="flex-grow-1 text-right m-1">
                                        <button class="btn btn-primary">Присоединиться</button>
                                    </div>
                                @endif
                            </div>
                        </form>
                    @endforeach
                </div>
            </div>
        </div>
        {{--<div class="text-center mt-4">
            <a class="btn btn-lg btn-outline-primary btn-rounded " href="{{ URL::previous() }}">Вернуться назад</a>
        </div>--}}
    </div>
@endsection
