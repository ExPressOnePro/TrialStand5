@extends('layouts.app')
@section('title') Meeper | Новые права @endsection
@section('content')

    <div class="main-content pt-4">
        <div class="separator-breadcrumb border-top"></div>
        <div class="row">
            <div class="card mb-4">
                <div class="card-body">
                    <div class="card-title mb-3">Новые права</div>
                    <form method="POST" action="{{ route('createNewPermission') }}">
                        @csrf
                        <div class="row">
                            <div class="col-md-12 form-group mb-3">
                                <label for="name">Название права</label>
                                <input class="form-control form-control-rounded @error('name') is-invalid @enderror" id="name" type="text" name="name" placeholder="Введите название Права">
                            </div>
                            <div class="col-md-6">
                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="col-md-12 form-group mb-3">
                                <label for="location">Сокращение права</label>
                                <input class="form-control form-control-rounded  @error('slug') is-invalid @enderror" name="slug'" id="slug'" type="text" placeholder="Введите сокращение права">
                            </div>
                            <div class="col-md-6">
                                @error('slug')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="col-md-12">
                                <button class="btn btn-primary">Создать</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
