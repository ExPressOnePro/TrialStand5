@extends('layouts.app')
@section('title') Meeper | Настройки@endsection
@section('content')
        <div class="main-content pt-4">
        <div class="breadcrumb">
            <h1 class="mr-2">Стенд</h1>
            <ul>
                <li><a href="">страница</a></li>
                <li></li>
            </ul>
        </div>
        <div class="separator-breadcrumb border-top"></div>
        <button class="btn btn-primary btn-block mb-3" id="alert-confirm" type="button">Confirm Alert</button>
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12">
                <div class="card">
                    <div class="card-header d-flex align-items-center">
                        <h1 class="heading float-left card-title m-0">Активное время</h1>
                    </div>
                    <form method="post" id="StandTime" action="{{ route('StandTime') }}">
                    <div class="card-body text-center">
                        <div class="row">
                            @foreach($active_day as $actday)
                            <div class="col-md-3">
                                <div class="card mt-2 m-1">
                                    <h5 class="display heading mt-1 mb-2">{{ \App\Enums\WeekDaysEnum::getWeekDay($actday->day)}}</h5>
                                        @csrf
                                    @foreach($template as $item)
                                        @if(
                                        $item->day === $actday->day
                                        )
                                            <div class="row align-items-center">
                                                <div class="col-md-6">
                                                    <h5 class="heading">{{ $item->id }}|{{ $item->time }}</h5>
                                                </div>
                                                <div class="col-md-6">
                                                    <label class="switch  switch-success ">
                                                        <input type="checkbox" name="items[]" value="{{ $item->id }}" {{ $item->status == 1 ? 'checked="checked"' : '' }}>
                                                        <span class="slider"></span>
                                                    </label>
                                                </div>
                                            </div>
                                        @endif
                                    @endforeach

                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                        <button class="btn btn-success" type="submit">Сохранить изменения</button>
                    </form>
                </div>
            </div>
        </div>
    </div>



@endsection
