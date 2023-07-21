@extends('layouts.app')
@section('title') Meeper | Роли и Права @endsection
@section('content')

    <div class="main-content pt-4">
        <div class="separator-breadcrumb border-top"></div>
        <div class="row">
            <div class="col-md-3">
                <div class="card mb-4">
                    <div class="card-header heading text-center text-25">Роли</div>
                    <div class="card-body">
                        @foreach($roles as $role)
                            <div class="form-group">
                                <a href="{{ route('rolesPermissionsChoiceRole', $role->id) }}">
                                    <button class="btn btn-info btn-block">{{ $role->name }}</button>
                                </a>
                            </div>
                        @endforeach
                    </div>
                    <div class="card-footer text-center">
                        <a class="btn btn-primary text-xl-center" href="{{ route('createNewPermission') }}">Добавить новую роль</a>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card mb-4">
                    <div class="card-header heading text-center text-25">Права</div>
                    <div class="card-body">
                        @foreach($permissions as $permission)
                            <div class="form-group">
                                <a href="{{ route('rolesPermissionsChoiceRole', $permission->id) }}">
                                    <button class="btn btn-dark btn-block">{{ $permission->name }}</button>
                                </a>
                            </div>
                        @endforeach
                    </div>
                    <div class="card-footer text-center">
                        <a class="btn btn-primary text-xl-center" href="{{ route('createNewRole') }}">Добавить новые права</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
