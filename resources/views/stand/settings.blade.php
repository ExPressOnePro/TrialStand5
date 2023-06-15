@extends('layouts.app')
@section('title') Meeper | Настройки @endsection
@section('content')
    <div class="main-content pt-4">
        <div class="separator-breadcrumb border-top"></div>
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12">
                <div class="card">
                    <div class="card-header d-flex align-items-center">
                        <h1 class="heading float-left card-title m-0">Активное время</h1>
                    </div>
                    <form method="post" action="{{ route('StandTimeNext', ['id' => $stand_id->id]) }}">
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
                                                            <h5 class="heading">{{ $item->time }}</h5>
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
                        <div class="card-footer text-right">
                            <button class="btn btn-primary mb-3" type="submit" href="{{ route('StandTimeNext',['id' => $stand_id->id] ) }}">
                            {{ __('Изменения со следующей недели') }}</button>
                        </div>
                    </form>
                </div>
                <div class="card-footer text-right">
                    <a href="{{ route('StandTimeNextToCurrent', ['id' => $stand_id->id]) }}">
                        <button class="btn btn-warning mb-3" type="submit">{{ __('Изменения с текущей недели') }}</button>
                    </a>
                </div>

                    {{--<span>Изменения и к текущей недели</span>
                    <button class="btn btn-warning" type="submit" href="{{ route('StandTimeNextToCurrent', ['id' => $stand_id->id]) }}">
                        {{ __('ТЕКУЩАЯ') }}</button>--}}
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
