@extends('Mobile.layouts.front.app')
@section('title') Meeper | Таблица @endsection
@section('content')


    @can('Stand-Create new stand')
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
                                    @foreach($congregations as $congregation)
                                        <option id="congregation" value="{{ $congregation->id }}">{{ $congregation->name }}</option>
                                    @endforeach
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

    <div class="content container-fluid">
        @can('Stand-Create new stand')
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
        <div class="row row-cols-1">
            @foreach($accessible_stands_for_the_user as $asfu)
                <div class="col mb-3 mb-lg-5">
                    <div class="card card-body">
                        <div class="d-flex align-items-center">
                            <a class="d-flex align-items-center me-2" href="{{ route('currentWeekTableFront', $asfu->id) }}">
                                <div class="flex-grow-1">
                                    <h5 class="text-hover-primary mb-0">{{ $asfu->name }}</h5>
                                    <span class="fs-6 text-body">{{ $asfu->location }}</span>
                                </div>
                            </a>

                            <div class="ms-auto d-flex justify-content-between">
                                <a class="btn btn-primary me-2" href="{{ route('currentWeekTableFront', $asfu->id) }}">
                                    открыть
                                </a>

                                @can('Stand-Open settings stand')
                                    <div class="dropdown">
                                        <button type="button" class="btn btn-ghost-secondary btn-icon btn-sm card-dropdown-btn rounded-circle" id="projectsListDropdown3" data-bs-toggle="dropdown" aria-expanded="false">
                                            <i class="bi-three-dots-vertical"></i>
                                        </button>
                                        @can('Stand-Open settings stand')
                                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="projectsListDropdown3">
                                                @can('Stand-Open settings stand')
                                                    <a class="dropdown-item" href="{{ route('StandSettings', $asfu->id) }}">{{ __('text.Settings') }}</a>
                                                @endcan
                                                @can('Stand-Open history stand')
                                                    <a class="dropdown-item" href="{{ route('history', $asfu->id) }} ">{{ __('text.History') }}</a>
                                                @endcan

                                                <div class="dropdown-divider"></div>
                                                <a class="dropdown-item text-danger" href="#">Delete</a>
                                            </div>
                                        @endcan
                                    </div>
                                @endcan
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

@endsection
