@extends('layouts.app')
@section('title') Meeper | Роли и Права @endsection
@section('content')

    <div class="main-content pt-4">
        <div class="separator-breadcrumb border-top"></div>
        <div class="row">
            <div class="col-lg-12 col-md-12">
                <div class="card mb-4">
                    <div class="card-body">
                        <h3 class="card-header-pills heading text-center text-primary">{{ $role->name }}</h3>
                        <p class="card-text heading text-center">Разрешения  для текущей роли</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card mb-4">
                    <div class="card-header heading text-center text-25">Права</div>
                    <div class="card-body">
                        {{--@foreach($permissions as $permission)
                                <div class="row">
                                    <div class="col mb-3">
                                        <h4 class="heading text-left">{{$permission->Permission->name}}</h4>
                                    </div>
                                    @if(DB::table('roles_permissions')
                                        ->where('role_id', '=', $role->id)
                                        ->where('permission_id', '=', $permission->id)
                                        ->count() > 0)
                                        <div class="col mb-3">
                                        <span class="text-success heading text-left">
                                            <i class="fa-solid fa-circle-check"></i> Доступная роль</span>
                                            <form method="post" action="">
                                                @csrf
                                                <input type="hidden" name="delete_role_id" value="{{ $permission->id }}">
                                                <button class="btn btn-danger btn-sm">Запретить</button>
                                            </form>
                                        </div>
                                    @else
                                        <form method="post" action="">
                                            @csrf
                                            <div class="col-md-6 mb-3">
                                                <input type="hidden" name="allow_role_id" value="{{ $permission->id }}">
                                                <button class="btn btn-primary btn-sm">Разрешить</button>
                                            </div>
                                        </form>
                                    @endif
                                </div>
                            @endforeach--}}
                            @foreach($permissions as $permission)
                                <div class="row">
                                    <div class="col mb-3">
                                        <h4 class="heading text-left">{{$permission->name}}</h4>
                                    </div>
                                    @if(DB::table('roles_permissions')
                                    ->where('role_id', '=', $role->id)
                                    ->where('permission_id', '=', $permission->id)
                                    ->count() > 0)
                                        <div class="col mb-3">
                                        <span class="text-success heading text-left">
                                            <i class="fa-solid fa-circle-check"></i> Доступная роль</span>
                                            <form method="post" action="{{ route('rolePermissionDelete', $role->id) }}">
                                                @csrf
                                                <input type="hidden" name="delete_role_id" value="{{ $permission->id }}">
                                                <button class="btn btn-danger btn-sm">Запретить</button>
                                            </form>
                                        </div>
                                    @else
                                        <form method="post" action="{{ route('rolePermissionAllow', $role->id) }}">
                                            @csrf
                                            <div class="col-md-6 mb-3">
                                                <input type="hidden" name="allow_role_id" value="{{ $permission->id }}">
                                                <button class="btn btn-primary btn-sm">Разрешить</button>
                                            </div>
                                        </form>
                                    @endif
                                </div>
                            @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
