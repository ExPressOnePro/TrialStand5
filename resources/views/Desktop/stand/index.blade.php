@extends('Desktop.layouts.app')
@section('title') Meeper | Стенды @endsection
@section('content')

    <div class="main-content pt-4">
        @can('Stand-Create new stand')
            <div class="row">
                <div class="col-md-3 mb-4 heading text-center mt-0">
                    <button class="btn btn-success btn-block" type="button" data-toggle="modal" data-target="#createNewStand">
                        Создать новый стенд
                    </button>
                </div>
            </div>
        @endcan
        <div class="separator-breadcrumb border-top"></div>
        @can('Stand-Open stand table')
            <div class="row">
                @foreach($accessible_stands_for_the_user as $asfu)
                    <div class="col-md-3">
                        <div class="card card-body mb-4">
                            <div class="text-center mb-2">
                                <h1 class="heading">{{ $asfu->name }}</h1>
                                <h5 class="mb-3 heading">{{ __('text.place') }}<br>"{{ $asfu->location }}"</h5>
                                <a href="{{ route('currentWeekTable', $asfu->id) }}">
                                    <button class="btn btn-block btn-info text-20">
                                        <i class="fa-solid fa-eye"></i>
                                        {{ __('text.Open') }}</button>
                                </a>
                            </div>
                            @can('Stand-Open settings stand')
                                <div class="text-right mb-2">
                                    <a href="{{ route('StandSettings', $asfu->id) }} ">
                                        <button class="btn btn-block btn-light text-20">
                                            <i class="fa-solid fa-gear"></i>
                                            {{ __('text.Settings') }}</button>
                                    </a>
                                </div>
                            @endcan
                            @can('Stand-Open history stand')
                                <div class="text-right mb-2">
                                    <a href="{{ route('history', $asfu->id) }} ">
                                        <button class="btn btn-block btn-light text-20">
                                            <i class="fa-solid fa-clock-rotate-left"></i>
                                            {{ __('text.History') }}</button>
                                    </a>
                                </div>
                            @endcan
                        </div>
                    </div>
                @endforeach

            </div>
        @endcan
    </div>


    @can('Stand-Create new stand')
    <div class="modal fade" id="createNewStand" tabindex="-1" role="dialog" aria-labelledby="createNewStand-2" style="display: none;" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createNewStand-2">Создать новый стенд</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>

                <div class="modal-body">
                    <form id="NewStand" method="POST" action="{{ route('createNewStand') }}">
                        @csrf
                        <div class="row">
                            <div class="col-md-12 form-group mb-3">
                                <label for="name">Название стенда</label>
                                <input class="form-control form-control-rounded @error('name') is-invalid @enderror" id="name" type="text" name="name" placeholder="Введите название стенда">
                            </div>
                            <div class="col-md-6">
                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                @enderror
                            </div>
                            <div class="col-md-12 form-group mb-3">
                                <label for="location">Локация стенда</label>
                                <input class="form-control form-control-rounded  @error('location') is-invalid @enderror" name="location" id="location" type="text" placeholder="Введите локацию стенда">
                            </div>
                            <div class="col-md-6">
                                @error('location')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="col-md-12 form-group mb-3">
                                <label for="congregation">Собрание</label>
                                <select class="form-control form-control-rounded" id="congregation" name="congregation" type="text">
                                    @foreach($congregations as $congregation)
                                        <option id="congregation" value="{{ $congregation->id }}">{{ $congregation->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="submit" data-dismiss="modal">Закрыть</button>
                    <a class="btn btn-success" type="button" href="{{ route('createNewStand') }}"
                       onclick="event.preventDefault();
                                    document.getElementById('NewStand').submit();">
                        Создать
                    </a>
                </div>
            </div>
        </div>
    </div>
    @endcan
@endsection
