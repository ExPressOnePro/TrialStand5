@extends('layouts.app')
@section('title') Meeper | Собрание @endsection
@section('content')

    <div class="main-content pt-4">
        <div class="breadcrumb">
            <h1 class="mr-2">Собрание</h1>
            <ul>
                <li><a href="">страница</a></li>
                <li></li>
            </ul>
        </div>
        <div class="separator-breadcrumb border-top"></div>


        <!-- Информация-->
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-6">
                <div class="card mb-4">
            <div class="card-body p-0">
                <div class="card-title border-bottom d-flex align-items-center m-0 p-3">
                    <span class="flex-grow-1">{{$congregation->name}}</span>
                    <span class="flex-grow-1"></span>
                    <span class="badge badge-pill badge-warning">Updated daily</span>
                </div>
                <div class="d-flex border-bottom justify-content-between p-3">
                    <div class="flex-grow-1">
                        <span class="text-small text-muted">Количество участников</span>
                        <h5 class="m-0">{{ $countUsers }}</h5>
                    </div>
                    <div class="flex-grow-1">
                        <span class="text-small text-muted">Количество групп</span>
                        <h5 class="m-0">...</h5>
                    </div>
                    <div class="flex-grow-1">
                        <span class="text-small text-muted">Количество...</span>
                        <h5 class="m-0">...</h5>
                    </div>
                </div>
            </div>
        </div>
            </div>
            <div class="col-lg-6 col-md-12">
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
                                        <td scope="row">{{ $conReq->user->name }}</td>
                                        <td scope="row">{{ $conReq->user->email }}</td>
                                        <td>
                                            <a class="text-success mr-2" href="{{ route('congregationAllow', [ 'id' => $congregation->id, 'user_id' => $conReq->user_id, 'conReq' => $conReq->id]) }}">
                                                <button class="btn btn-success">Разрешить</button>
                                            </a>
                                            <a class="text-success mr-2" href="#">
                                                <button class="btn btn-danger" href="{{ route('congregationReject', [ 'id' => $congregation->id, 'conReq' => $conReq->id]) }}">Запретить</button>
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
        <div class="separator-breadcrumb border-top"></div>
        <!---->

        <!-- Управляющие-->
        <div class="breadcrumb">
            <h1 class="mr-2">Управляющие</h1>
            <button class="btn btn-outline-primary text-center">
                <i class="fa-solid fa-plus text-24"></i>

            </button>
        </div>
        <div class="row">
            @foreach($managerCongregation as $manCon)
            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="card card-icon-bg card-icon-bg-primary o-hidden mb-4">
                    <div class="card-body text-center">

                        <p class="heading text-primary line-height-1 mb-2">
                            {{ $manCon->name }}
                        </p>
                        <div class="content">
                            <a href="{{ route('userCard', $manCon->id) }}">
                                <button class="btn btn-outline-success">Открыть аккаунт</button>
                            </a>

                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        <div class="separator-breadcrumb border-top"></div>
        <!---->

        <!-- Members-->
        <div class="row">
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
                                        @foreach($user as $us)
                                        <tr>
                                            <th scope="row">{{ $us->id }}</th>
                                            <td>{{ $us->name }}</td>
                                            <td>{{ $us->email }}</td>
                                            <td><span class="badge badge-success">Active</span></td>
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
        </div>
        <div class="separator-breadcrumb border-top"></div>
        <!---->

    </div>

@endsection
