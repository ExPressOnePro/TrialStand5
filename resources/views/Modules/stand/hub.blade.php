@extends('Mobile.layouts.front.app')
@section('title') Meeper @endsection
@section('content')

    <div class="content container-fluid">
        @can('stand.create')
            <div class="row mb-4">
                <div class="col-12">
                    <div class="d-grid gap-2">
                        <button type="button" class="btn btn-primary btn-lg" data-bs-toggle="modal" data-bs-target="#exampleModal">
                            Создать новый стенд
                        </button>
                    </div>
                </div>
            </div>
        @endcan
        @can('module.stand')
                <div class="row">
                    @foreach($accessible_stands_for_the_user as $asfu)
                        <div class="col-md-4">
                            <div class="list-group d-flex justify-content-between align-items-start mt-3">
                                <div class="list-group-item list-group-item-action border-secondary">
                                    <div class="d-flex align-items-center">
                                        <a class="text-decoration-none" href="
                                        @if(isset($userInfo["stand_settings"]) && $userInfo["stand_settings"] == 1)
                {{ route('stand.aio_current') }}
            @else
                {{ route('stand.current', $asfu->id) }}
            @endif">

{{--                            @if(auth()->user()->can('stand.settings') && isset($userInfo["stand_settings"]) && $userInfo["stand_settings"] == 1)--}}
{{--                                {{ route('stand.allInOneCurrent') }}--}}
{{--                            @elseif(isset($userInfo["stand_settings"]) && $userInfo["stand_settings"] == 1)--}}
{{--                                {{ route('stand.allInOneCurrent') }}--}}
{{--                            @else--}}
{{--                                {{ route('currentWeekTableFront', $asfu->id) }}--}}
{{--                            @endif">--}}
                                            <div class="ms-1">
                                                <span class="d-block h1 text-inherit mb-0">{{ $asfu->name }}</span>
                                                <span class="d-block h5 text-inherit text-body mb-0">{{ $asfu->location }}</span>
                                            </div>
                                        </a>
                                        @can('stand.settings')
                                            <div class="dropdown ms-auto">
                                                <button type="button" class="btn btn-ghost-secondary btn-icon btn-sm card-dropdown-btn rounded-circle" id="projectsListDropdown3" data-bs-toggle="dropdown" aria-expanded="false">
                                                    <i class="fa-solid fa-ellipsis-vertical"></i>
                                                </button>
                                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="projectsListDropdown3">
                                                    @can('stand.settings')
                                                        <a class="dropdown-item" href="{{ route('stand.settings', $asfu->id) }}">{{ __('text.Настройки') }}</a>
                                                    @endcan
                                                    @can('stand.history')
                                                        <a class="dropdown-item" href="{{ route('stand.history', $asfu->id) }}">{{ __('text.История') }}</a>
                                                    @endcan
                                                    <div class="dropdown-divider"></div>
                                                    {{--                                    <a class="dropdown-item text-danger" href="#">Delete</a>--}}
                                                </div>
                                            </div>
                                        @endcan
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
        @endcan
        @can('stand.create')
            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Новый стенд</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
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
                                            <option id="congregation" value="{{ $congregation->id }}">{{ $congregation->name }}</option>
                                        </select>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">закрыть</button>
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
    </div>

@endsection
