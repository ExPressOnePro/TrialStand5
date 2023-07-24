@extends('layouts.app')
@section('title') Meeper | Собрание @endsection
@section('content')

    <div class="main-content pt-4">
        <h1 class="heading text-center font-weight-bold">{{ $congregation->name }}</h1>
        <!-- Информация-->
        <div class="row">
            <div class="col-12">
                    <div class="card mb-4">
                        <div class="card-body p-0">
                            <div class="d-flex border-bottom justify-content-between p-3">
                                <div class="flex-grow-1">
                                    <span class="text-small text-muted">Количество возвещателей</span>
                                    <h5 class="m-0">{{ $countUsers }}</h5>
                                </div>
                                <div class="flex-grow-1">
                                    <span class="text-small text-muted">Количество групп</span>
                                    <h5 class="m-0">{{ $countGroups}}</h5>
                                </div>
                                <div class="flex-grow-1">
                                    <span class="text-small text-muted">Количество Старейшин</span>
                                    <h5 class="m-0">{{ $countOverseers }}</h5>
                                </div>
                                <div class="flex-grow-1">
                                    <span class="text-small text-muted">Количество служебных помошников</span>
                                    <h5 class="m-0"></h5>
                                </div>
                                <div class="flex-grow-1">
                                    <span class="text-small text-muted">Количество общих пионеров</span>
                                    <h5 class="m-0"></h5>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <!-- Группы собрания-->
            <div class="col-md-4">
                <div class="card mb-4">
                    <div class="card-title border-bottom d-flex align-items-center m-0 p-3">
                        <span class="flex-grow-1">Группы собрания</span>
                        <span class="flex-grow-1"></span>
                    </div>
                    <div class="card-body">
                        @foreach($groups as $group)
                            <div class="d-flex align-items-center mt-2">
                                <div class="flex-grow-1">
                                    <h4 class="m-0">{{$group->name}}</h4>
                                        <p class="m-0 text-small text-muted">Ответственный: {{$group->responsibleUserId->first_name }} {{$group->responsibleUserId->last_name }}</p>
                                </div>

                                <div>
                                    <a href="{{ route('groupView', ['congregation_id' => $congregation->id, 'group_id' => $group->id]) }}">
                                        <button class="btn btn-outline-primary">Просмотреть детальнее</button>
                                    </a>
                                </div>
                            </div>
                        @endforeach

                        {{--@foreach($permission_Overseer as $permission_Oversee)
                            @foreach($permission_Overseer as $permission_Overse)
                                @foreach($permission_Overse as $permission_Overs)
                                <div class="d-flex align-items-center border-bottom-dotted-dim">
                                    <div class="flex-grow-1">
                                        <h6 class="m-0">{{$permission_Overs->User->first_name}} {{$permission_Overs->User->last_name}}</h6>
                                        <p class="m-0 text-small text-muted"></p>
                                    </div>
                                    <div>
                                        <button class="btn btn-outline-primary">Follow</button>
                                    </div>
                                </div>
                                @endforeach
                            @endforeach
                        @endforeach--}}
                    </div>
                </div>
            </div>
            @if($congregationRequestsCount > 0)
            <div class="col-md-4">
                    <div class="card o-hidden mb-4">
                        <div class="card-header d-flex align-items-center border-0">
                            <h3 class="w-50 card-title m-0">Запросы на добавление к собранию</h3>

                        </div>
                        <div>
                            <div class="table-responsive">
                                <table class="table text-center" id="user_table">
                                    <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Name</th>
                                        <th scope="col">Email</th>
                                        <th scope="col">Действие</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($congregationRequests as $conReq)
                                        <tr>
                                            <th scope="row">{{ $conReq->user_id }}</th>
                                            <th scope="row">{{ $conReq->user->first_name }} {{ $conReq->user->last_name }}</th>
                                            <th scope="row">{{ $conReq->user->email }}</th>
                                            <th>
                                                <a class="text-success mr-2" href="{{ route('congregationAllow', [ 'id' => $congregation->id, 'user_id' => $conReq->user_id, 'conReq' => $conReq->id]) }}">
                                                    <button class="btn btn-success">Разрешить</button>
                                                </a>
                                                <a class="text-success mr-2" href="#">
                                                    <button class="btn btn-danger" href="{{ route('congregationReject', [ 'id' => $congregation->id, 'conReq' => $conReq->id]) }}">Запретить</button>
                                                </a>
                                            </th>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            @else
            @endif
            <div class="col-md-4">
                    <div class="card mb-4">
                        <div class="card-body p-0">
                            <div class="card-title border-bottom d-flex align-items-center m-0 p-3">
                                <span class="flex-grow-1">Разрешения пользователей для стенда</span>
                                <span class="flex-grow-1"></span>
                            </div>
                            @foreach($permission_stands as $permission_stand)
                                <div class="d-flex border-bottom justify-content-between p-3">
                                    <div class="flex-grow-1 text-left">
                                        <span class="text-left text-muted">Количество участников</span>
                                        <h5 class="m-0">{{ $permission_stand->name}}</h5>
                                    </div>
                                    <div class="flex-grow-1 text-right">
                                        <span class="text-right text-muted">Количество групп</span>
                                        <h5 class="m-0">...</h5>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            {{--<div class="col-4">
                    @foreach($managerCongregation as $manCon)
                        <div class="card card-icon-bg card-icon-bg-primary o-hidden mb-4 text-center">
                            <div class="card-body text-center mb-2">
                                <p class="heading">
                                    {{ $manCon->first_name }} {{ $manCon->last_name }}
                                </p>
                                <div class="content">
                                    <a href="{{ route('userCard', $manCon->id) }}">
                                        <button class="btn btn-outline-success">Открыть аккаунт</button>
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>--}}
        </div>

        <!---->


        <!-- Информация-->
        {{--<div class="row">
            <div class="col-lg-6 col-md-6 col-sm-6">
                <div class="card mb-4">
                    <div class="card-body p-0">
                        <div class="card-title border-bottom d-flex align-items-center m-0 p-3">
                            <span class="flex-grow-1">Разрешения пользователей для стенда</span>
                            <span class="flex-grow-1"></span>
                        </div>
                        @foreach($permission_stands as $permission_stand)
                        <div class="d-flex border-bottom justify-content-between p-3">
                            <div class="flex-grow-1 text-left">
                                <span class="text-left text-muted">Количество участников</span>
                                <h5 class="m-0">{{ $permission_stand->name}}</h5>
                            </div>
                            <div class="flex-grow-1 text-right">
                                <span class="text-right text-muted">Количество групп</span>
                                <h5 class="m-0">...</h5>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>--}}
        <!---->
        <!-- Управляющие-->
        {{--<div class="row">

            <div class="col-lg-3 col-md-6 col-sm-6">
                @foreach($managerCongregation as $manCon)
                <div class="card card-icon-bg card-icon-bg-primary o-hidden mb-4 text-center">
                    <div class="card-body text-center mb-2">
                        <p class="heading">
                            {{ $manCon->first_name }} {{ $manCon->last_name }}
                        </p>
                        <div class="content">
                            <a href="{{ route('userCard', $manCon->id) }}">
                                <button class="btn btn-outline-success">Открыть аккаунт</button>
                            </a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>--}}
        <!---->

        <!-- Members-->
        {{--<div id="preferencesSection" class="row">
            <div class="col-lg-12 col-md-12">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card o-hidden mb-4">
                            <div class="card-header d-flex align-items-center border-0">
                                <h3 class="w-50 float-left card-title m-0">Участники </h3>
                                <div class="dropdown dropleft text-right w-50 float-right">
                                    <button class="btn bg-gray-100" id="dropdownMenuButton1" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="nav-icon i-Gear-2"></i>
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                        <a class="dropdown-item" href="#">Add new user</a>
                                        <a class="dropdown-item" href="#">View All users</a><a class="dropdown-item" href="#">Something else here</a></div>
                                </div>
                            </div>
                            <div>
                                <div class="table-responsive">
                                    <table class="table text-center" id="user_table">
                                        <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Name</th>
                                            <th scope="col">Email</th>
                                            <th scope="col">Номер телефона</th>
                                            <th scope="col">Группа</th>
                                            <th scope="col">Status</th>
                                            <th scope="col">Больше</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($users as $user)
                                        <tr>
                                            <th scope="row">{{ $user->id }}</th>
                                            <td>{{ $user->first_name }} {{ $user->last_name }}</td>
                                            <td>{{ $user->email }}</td>
                                            <td>{{ $user->mobile_phone }}</td>
                                            <td>
                                                <a class="text-success mr-2" href="#">
                                                    <i class="nav-icon i-Pen-2 font-weight-bold"></i>
                                                </a>
                                                <a class="text-danger mr-2" href="#">
                                                    <i class="nav-icon i-Close-Window font-weight-bold"></i>
                                                </a>
                                            </td>
                                        </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>--}}

        <!---->

    </div>

@endsection
