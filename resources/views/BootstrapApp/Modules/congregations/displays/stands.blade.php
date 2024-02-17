@extends('BootstrapApp.layouts.app')
@section('title') Meeper | Собрание @endsection
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
        <div class="row row-cols-1">
                @foreach($accessible_stands_for_the_user as $asfu)
                <div class="col mb-3 mb-lg-5">
                    <!-- Card -->
                    <div class="card gradient-radial-sm-primary h-100">
                        <!-- Body -->
                        <div class="card-body pb-0">
                            <div class="row align-items-center mb-2">
                                <div class="col-9">
                                    <h4 class="mb-1">
                                        <a>{{ $asfu->name }}</a>
                                    </h4>
                                </div>
                                <!-- End Col -->

                                <div class="col-3 text-end">
                                    <!-- Dropdown -->
                                    @can('stand.settings')
                                        <div class="dropdown">
                                            <button type="button" class="btn btn-ghost-secondary btn-icon btn-sm card-dropdown-btn rounded-circle" id="projectsListDropdown3" data-bs-toggle="dropdown" aria-expanded="false">
                                                <i class="bi-three-dots-vertical"></i>
                                            </button>
                                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="projectsListDropdown3">
                                                <a class="dropdown-item" href="{{ route('currentWeekTableFront', $asfu->id) }}">Открыть</a>
                                                <div class="dropdown-divider"></div>
                                                @can('stand.settings')
                                                    <a class="dropdown-item" href="{{ route('stand.settings', $asfu->id) }}">{{ __('text.Settings') }}</a>
                                                @endcan
                                                @can('stand.history')
                                                    <a class="dropdown-item" href="{{ route('stand.history', $asfu->id) }} ">{{ __('text.History') }}</a>
                                                @endcan

                                                <div class="dropdown-divider"></div>
{{--                                                <a class="dropdown-item text-danger" href="#">Delete</a>--}}
                                            </div>
                                        </div>
                                    @endcan

                                </div>
                            </div>
                                <p>{{ $asfu->location }}</p>
                        </div>
                        <div class="card-footer border-0 pt-0">
                            <div class="list-group list-group-flush list-group-no-gutters">
                                <div class="list-group-item">
                                    <div class="row align-items-center">
                                        <div class="col">
                                            <span class="card-subtitle">Статус стенда</span>
                                        </div>
                                        <div class="col-auto">
                                            <a class="badge bg-success p-2">Активен</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
    </div>
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
@endsection
