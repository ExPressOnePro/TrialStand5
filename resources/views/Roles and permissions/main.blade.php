@extends('layouts.app')
@section('title') Meeper | Роли и Права @endsection
@section('content')
    {{--@inject('mobile_detect', 'Mobile_Detect')
    @if ($mobile_detect->isMobile())
                --}}{{--<div class="col-lg-6">--}}{{--
                    <div class="card">
                        <div class="card-body">
                            <div class="card-title">
                                <h3>Роли</h3>
                            </div>
                            <div>
                                @foreach($roles as $role)
                                    <div class="card ul-card__v-space">
                                        <div class="card-header">
                                            <h6 class="card-title heading mb-0"><a class="text-default" data-toggle="collapse" href="#collapsible-item-nested-parent1{{ $role->id }}" aria-expanded="true">{{ $role->name }}</a></h6>
                                        </div>
                                        <div class="collapse" id="collapsible-item-nested-parent1{{ $role->id }}" style="">
                                            <div class="card-body">
                                                <!--  Child level -->
                                                @foreach($permissions as $permission)
                                                    <div class="card ul-card__v-space">
                                                        <div class="card-header bg-dark">
                                                            <h6 class="card-title mb-0">
                                                                <a class="text-white" data-toggle="collapse" href="#collapsible-item-nested-child1{{ $permission->id }}" aria-expanded="true">{{ $permission->name }}</a></h6>
                                                        </div>
                                                        <div class="collapse" id="collapsible-item-nested-child1{{ $permission->id }}" style="">
                                                            <div class="card-body">
                                                                Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch.

                                                            </div>
                                                        </div>
                                                    </div>

                                            @endforeach
                                            <!--  /child level -->
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
        <div class="modal fade" id="newRole" tabindex="-1" role="dialog" aria-labelledby="newRole_1" style="display: none;" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="newRole_1">Новая Роль</h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>

                    <div class="modal-body">
                        <div class="card  mb-3">
                            <div class="card-body">
                                <h5 class="heading">Первый возвещатель</h5>
                                <div class="row mb-3 mb-sm-0">
                                    <div class="col-md-12">
                                        <form id="changeForm" method="post" action="">
                                            @csrf
                                            <select class="form-control form-control-rounded heading mb-4" name="1_user_id" id="1_user_id">

                                            </select>
                                        </form>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="row">
                                            <div class="col text-left mb-3 mb-sm-0">
                                                <a href="">
                                                    <button class="btn btn-danger m-1" type="button" >
                                                        Выписать(ся)
                                                    </button>
                                                </a>
                                            </div>
                                            <div class="col text-right mb-3 mb-sm-0">
                                                <a href=""      onclick="event.preventDefault();
                                                        document.getElementById('changeForm').submit();">
                                                    <button class="btn btn-success m-1" type="button" >
                                                        Изменить запись
                                                    </button>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" type="submit" data-dismiss="modal">Закрыть</button>
                        <a class="btn btn-success" type="button" href=""
                           onclick="event.preventDefault();
                           document.getElementById('').submit();">
                            Записать
                        </a>
                    </div>
                </div>
            </div>
        </div>


    @elseif ($mobile_detect->isTablet())
        <div class="main-content pt-4">
            <div class="separator-breadcrumb border-top"></div>
            <div class="row">
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-title">
                                <h3>Роли</h3>
                            </div>
                            <div>
                                @foreach($roles as $role)
                                    <div class="card ul-card__v-space">
                                        <div class="card-header">
                                            <h6 class="card-title heading mb-0"><a class="text-default" data-toggle="collapse" href="#collapsible-item-nested-parent1{{ $role->id }}" aria-expanded="true">{{ $role->name }}</a></h6>
                                        </div>
                                        <div class="collapse" id="collapsible-item-nested-parent1{{ $role->id }}" style="">
                                            <div class="card-body">
                                                <!--  Child level -->
                                                @foreach($permissions as $permission)

                                                    <div class="card ul-card__v-space">
                                                        <div class="card-header bg-dark">
                                                            <h6 class="card-title mb-0">
                                                                <a class="text-white" data-toggle="collapse" href="#collapsible-item-nested-child1{{ $permission->id }}" aria-expanded="true">{{ $permission->name }}</a></h6>
                                                        </div>
                                                        <div class="collapse" id="collapsible-item-nested-child1{{ $permission->id }}" style="">
                                                            <div class="card-body">
                                                                Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch.

                                                            </div>
                                                        </div>
                                                    </div>

                                            @endforeach
                                            <!--  /child level -->
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card mb-4">
                        <div class="card-header heading text-center text-25">Роли</div>
                        <div class="card-body">
                            --}}{{--@foreach($roles as $role)
                                <div class="form-group">
                                    <a href="{{ route('rolesPermissionsChoiceRole', $role->id) }}">
                                        <button class="btn btn-info btn-block">{{ $role->name }}</button>
                                    </a>
                                </div>
                            @endforeach--}}{{--
                        </div>
                        <div class="card-footer text-center">
                            <button class="btn btn-primary text-xl-center" type="button" data-toggle="modal" data-target="#newRole" data-id="">
                                Добавить новую роль
                            </button>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card mb-4">
                        <div class="card-header heading text-center text-25">Права</div>
                        <div class="card-body">
                            --}}{{--@foreach($permissions as $permission)
                                <div class="form-group">
                                    <a href="{{ route('rolesPermissionsChoiceRole', $permission->id) }}">
                                        <button class="btn btn-dark btn-block">{{ $permission->name }}</button>
                                    </a>
                                </div>
                            @endforeach--}}{{--
                        </div>
                        <div class="card-footer text-center">
                            <button class="btn btn-primary text-xl-center" type="button" data-toggle="modal" data-target="#newRole" data-id="">
                                Новая Роль
                            </button>
                            <a class="btn btn-primary text-xl-center" href="{{ route('createNewRole') }}">Добавить новые права</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="newRole" tabindex="-1" role="dialog" aria-labelledby="newRole_1" style="display: none;" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="newRole_1">Новая Роль</h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>

                    <div class="modal-body">
                        <div class="card  mb-3">
                            <div class="card-body">
                                <h5 class="heading">Первый возвещатель</h5>
                                <div class="row mb-3 mb-sm-0">
                                    <div class="col-md-12">
                                        <form id="changeForm" method="post" action="">
                                            @csrf
                                            <select class="form-control form-control-rounded heading mb-4" name="1_user_id" id="1_user_id">

                                            </select>
                                        </form>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="row">
                                            <div class="col text-left mb-3 mb-sm-0">
                                                <a href="">
                                                    <button class="btn btn-danger m-1" type="button" >
                                                        Выписать(ся)
                                                    </button>
                                                </a>
                                            </div>
                                            <div class="col text-right mb-3 mb-sm-0">
                                                <a href=""      onclick="event.preventDefault();
                                                        document.getElementById('changeForm').submit();">
                                                    <button class="btn btn-success m-1" type="button" >
                                                        Изменить запись
                                                    </button>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" type="submit" data-dismiss="modal">Закрыть</button>
                        <a class="btn btn-success" type="button" href=""
                           onclick="event.preventDefault();
                           document.getElementById('').submit();">
                            Записать
                        </a>
                    </div>
                </div>
            </div>
        </div>
    @else--}}
        <div class="main-content pt-4">
            <div class="separator-breadcrumb border-top"></div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card o-hidden mb-4">
                        <div class="card-header d-flex align-items-center border-0">
                            <h3 class="w-50 float-left card-title m-0">New Users</h3>
                            <div class="dropdown dropleft text-right w-50 float-right">
                                <button class="btn bg-gray-100" id="dropdownMenuButton1" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="nav-icon i-Gear-2"></i></button>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton1"><a class="dropdown-item" href="#">Add new user</a><a class="dropdown-item" href="#">View All users</a><a class="dropdown-item" href="#">Something else here</a></div>
                            </div>
                        </div>
                        <div>
                            <div class="table-responsive">
                                <table class="table text-center" id="user_table">
                                    <thead>
                                    <tr>
                                        <th>
                                            <a href="{{ route('sort.table', ['sort' => 'name']) }}">name</a>
                                        </th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($roles as $role)
                                        <tr>
                                            {{--<th scope="row">{{$role->id}}</th>--}}
                                            <td>{{$role->name}}</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-title">
                                <h3>Роли</h3>
                            </div>
                            <div>
                                @if(auth()->check() && auth()->user()->hasRole('Developer'))
                                    @foreach($roles as $role)
                                        <div class="card ul-card__v-space">
                                            <div class="card-header">
                                                <h6 class="card-title heading mb-0"><a class="text-default" data-toggle="collapse" href="#collapsible-item-nested-parent1{{ $role->id }}" aria-expanded="true">{{ $role->name }}</a></h6>
                                            </div>
                                            <div class="collapse" id="collapsible-item-nested-parent1{{ $role->id }}" style="">
                                                <div class="card-body">
                                                    <!--  Child level -->
                                                    @foreach($permissions as $permission)

                                                        <div class="card ul-card__v-space text-center">
                                                            <div class="card-header bg-dark">
                                                                <div class="d-flex justify-content-between">
                                                                    <div class="col-5">
                                                                        <h6 class="card-title text-left">
                                                                            <a class="text-white" data-toggle="collapse" href="#collapsible-item-nested-child1{{ $permission->permission->id }}" aria-expanded="true">{{ $permission->permission->name }}</a>
                                                                        </h6>
                                                                    </div>
                                                                    @if(DB::table('roles_permissions')
                                                                    ->where('role_id', '=', $role->id)
                                                                    ->where('permission_id', '=', $permission->permission->id)
                                                                    ->count() > 0)
                                                                        <div class="col-6 text-right">
                                                                            <span class="text-success heading">
                                                                                <i class="text-success fa-solid fa-circle-check"></i> Это право доступно
                                                                                <a class="btn btn-danger  btn-sm" type="button" href="{{ route('rolePermissionDelete', $role->id) }}"
                                                                                   onclick="event.preventDefault();
                                                                                       document.getElementById('deletePermission').submit();">
                                                                                    Запретить
                                                                                </a>
                                                                                <form id="deletePermission" method="post" action="{{ route('rolePermissionDelete', $role->id) }}">
                                                                                    @csrf
                                                                                    <input type="hidden" name="delete_role_id" value="{{ $permission->permission->id }}">
                                                                                </form>
                                                                            </span>

                                                                        </div>
                                                                    @else
                                                                        <div class="col-7 text-right">
                                                                        <span class="text-danger heading">
                                                                            <i class="text-danger fa-solid fa-ban"></i> Это право не доступно
                                                                            <a class="btn btn-success  btn-sm" type="button" href="{{ route('rolePermissionAllow', $role->id) }}"
                                                                               onclick="event.preventDefault();
                                                                                       document.getElementById('allowPermission').submit();">
                                                                                    Разрешить
                                                                                </a>
                                                                            <form id="allowPermission" method="post" action="{{ route('rolePermissionAllow', $role->id) }}">
                                                                                @csrf
                                                                                <div class="col-md-6">
                                                                                    <input type="hidden" name="allow_role_id" value="{{ $permission->permission->id }}">

                                                                                </div>
                                                                            </form>
                                                                        </span>
                                                                        </div>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                            <div class="collapse" id="collapsible-item-nested-child1{{ $permission->permission->id }}" style="">
                                                                <div class="card-body">
                                                                    Text
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                <!--  /child level -->
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach

                                @else
                                    @foreach($roles as $role)
                                        <div class="card ul-card__v-space">
                                            <div class="card-header">
                                                <h6 class="card-title heading mb-0"><a class="text-default" data-toggle="collapse" href="#collapsible-item-nested-parent1{{ $role->id }}" aria-expanded="true">{{ $role->name }}</a></h6>
                                            </div>
                                            <div class="collapse" id="collapsible-item-nested-parent1{{ $role->id }}" style="">
                                                <div class="card-body">
                                                    <!--  Child level -->
                                                    @foreach($permissions as $permission)
                                                        <div class="card ul-card__v-space">
                                                            <div class="card-header bg-dark">
                                                                <h6 class="card-title mb-0">
                                                                    <a class="text-white" data-toggle="collapse" href="#collapsible-item-nested-child1{{ $permission->permission_id }}" aria-expanded="true">{{ $permission->permission->name }}</a></h6>
                                                            </div>
                                                            <div class="collapse" id="collapsible-item-nested-child1{{ $permission->permission_id }}" style="">
                                                                <div class="card-body">
                                                                    Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch.

                                                                </div>
                                                            </div>
                                                        </div>

                                                @endforeach
                                                <!--  /child level -->
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="newRole" tabindex="-1" role="dialog" aria-labelledby="newRole_1" style="display: none;" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="newRole_1">Новая Роль</h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>

                    <div class="modal-body">
                        <div class="card  mb-3">
                            <div class="card-body">
                                <h5 class="heading">Первый возвещатель</h5>
                                <div class="row mb-3 mb-sm-0">
                                    <div class="col-md-12">
                                        <form id="changeForm" method="post" action="">
                                            @csrf
                                            <select class="form-control form-control-rounded heading mb-4" name="1_user_id" id="1_user_id">

                                            </select>
                                        </form>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="row">
                                            <div class="col text-left mb-3 mb-sm-0">
                                                <a href="">
                                                    <button class="btn btn-danger m-1" type="button" >
                                                        Выписать(ся)
                                                    </button>
                                                </a>
                                            </div>
                                            <div class="col text-right mb-3 mb-sm-0">
                                                <a href=""      onclick="event.preventDefault();
                                                        document.getElementById('changeForm').submit();">
                                                    <button class="btn btn-success m-1" type="button" >
                                                        Изменить запись
                                                    </button>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" type="submit" data-dismiss="modal">Закрыть</button>
                        <a class="btn btn-success" type="button" href=""
                           onclick="event.preventDefault();
                           document.getElementById('').submit();">
                            Записать
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="record1" tabindex="-1" role="dialog" aria-labelledby="record1" style="display: none;" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="record1">Запись для стенда  № </h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>

                <div class="modal-body">
                    <form id="recordStandFirst" method="post" action="">
                        @csrf
                        <p class="text-20 text-success text-center font-weight-bold line-height-1 mb-5" id="id">
                            Дата  <br> Время
                        </p>
                        <small class="text-muted"></small>
                        <div class="row mb-5">
                            <div class="col-md-12 mb-3 mb-sm-0">
                                <h5 class="font-weight-bold text-center">Первый возвещатель</h5>

                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="submit" data-dismiss="modal">Закрыть</button>
                    <a class="btn btn-success" type="button" href=""
                       onclick="event.preventDefault();
                           document.getElementById('recordStandFirst').submit();">
                        Записать
                    </a>
                </div>
            </div>
        </div>
    </div>
    {{--@endif--}}

    <script>
        $(function() {
            $('#table').on('click', 'th', function() {
                var column = $(this).data('sort-by');
                var direction = $(this).data('sort-asc') ? 'asc' : 'desc';

                // Send an AJAX request to the server to sort the table
                $.ajax({
                    url: '/sort',
                    type: 'POST',
                    data: {
                        column: column,
                        direction: direction
                    },
                    success: function(data) {
                        // Update the table with the sorted data
                        $('#table').html(data);
                    }
                });
            });
        });
    </script>
@endsection
