@extends('BootstrapApp.layouts.app')
@section('title') Meeper @endsection
@section('content')

    <div class="content container-fluid mb-5">
        @role('Developer')
            <div class="row mb-4">
                <div class="col-12">
                    <div class="d-grid gap-2">
                        <button type="button" class="btn btn-primary btn-lg" data-bs-toggle="modal" data-bs-target="#exampleModal">
                            Создать новое собрание
                        </button>
                    </div>
                </div>
            </div>
        @endrole
        <div class="row mb-5">
            @foreach($congregation as $con)
                <div class="col-md-3">
                    <a class="text-decoration-none text-dark" href="{{ route('congregationView', $con->id) }}" aria-expanded="true">
                        <div class="card card-body ul-border__bottom mb-4">
                            <div class="text-center">
                                <h3 class="heading">{{ $con->name }}</h3>
                            </div>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
    </div>

    @role('Developer')
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Новое собрание</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="NewStand" method="POST" action="{{ route('congregation.create') }}">
                            @csrf
                            <div class="row">
                                <div class="col-md-12 form-group mb-3">
                                    <label for="name">Название собрания</label>
                                    <input class="form-control form-control-rounded @error('name') is-invalid @enderror" id="name" type="text" name="name" placeholder="Введите название стенда">
                                </div>
                                <div class="col-md-6">
                                    @error('name')
                                    <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                    @enderror
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">закрыть</button>
                        <a class="btn btn-success" type="button" href="{{ route('congregation.create') }}"
                           onclick="event.preventDefault();
                                    document.getElementById('NewStand').submit();">
                            Создать
                        </a>

                    </div>
                </div>
            </div>
        </div>
    @endrole


@endsection
