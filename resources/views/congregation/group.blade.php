@extends('layouts.app')
@section('title') Meeper | ГРуппа @endsection
@section('content')

    <div class="main-content pt-4">
        <h1 class="heading text-center font-weight-bold">{{ $congregation->name }} / {{ $group->name }}</h1>
        <div class="separator-breadcrumb border-top"></div>
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
        </div>
        <ul class="nav nav-pills text-center" id="myPillTab" role="tablist">
            <li class="nav-item ">
                <a class="nav-link active show" id="home-icon-pill" data-toggle="pill" href="#usersPIll" role="tab" aria-controls="usersPIll" aria-selected="true">
                    <i class="fa-solid fa-file-invoice"></i>
                    Возвещатели
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="profile-icon-pill" data-toggle="pill" href="#reportsPIll" role="tab" aria-controls="reportsPIll" aria-selected="false">
                    <i class="nav-icon i-Home1 mr-1"></i>
                    Отчеты
                </a>
            </li>
        </ul>
        <div class="row">
            <div class="col-12">
                <div class="tab-content" id="myPillTabContent">
                    <div class="tab-pane fade active show" id="usersPIll" role="tabpanel" aria-labelledby="home-icon-pill">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title mb-3">Пользователи</h4>
                                <p></p>
                                <div class="table-responsive">
                                    <table class="display table table-striped table-bordered" id="zero_configuration_table" style="width:100%">
                                        <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Position</th>
                                            <th>Office</th>
                                            <th>Age</th>
                                            <th>Start date</th>
                                            <th>Salary</th>
                                            <th>Salary</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($users as $user1)
                                            @foreach($user1 as $user)
                                                <tr>
                                                    <td>
                                                        <a href="{{ route('userCard', $user->id) }}">
                                                            <div class="ul-widget-app__profile-pic">{{ $user->first_name }} {{ $user->last_name }}</div>
                                                        </a>
                                                    </td>
                                                    <td>{{ $user->email }}</td>
                                                    <td>{{ $user->mobile_phone }}</td>
                                                    <td>
                                                        @foreach($user->usersroles as $userRole)
                                                            @if($userRole->role->name === 'Developer')
                                                                <a class="badge badge-danger" href="#">{{ $userRole->role->name }}</a>
                                                            @else
                                                                <a class="badge badge-light" href="#">{{ $userRole->role->name }}</a>
                                                            @endif
                                                        @endforeach
                                                    </td>
                                                    <td>{{ $user->address }}</td>
                                                    <td>{{ $user->groups }}</td>
                                                    <td>
                                                        <a class="ul-link-action text-success" href="" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit"><i class="i-Edit"></i></a>
                                                        <a class="ul-link-action text-danger mr-1" href="" data-toggle="tooltip" data-placement="top" title="" data-original-title="Want To Delete !!!"><i class="i-Eraser-2"></i></a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="reportsPIll" role="tabpanel" aria-labelledby="reports-icon-pill">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title mb-3">Отчеты</h4>
                                <p></p>
                                <div class="table-responsive">
                                    <table class="display table table-striped table-bordered" id="zero_configuration_table" style="width:100%">
                                        <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>часы</th>
                                            <th>публикации</th>
                                            <th>повторы</th>
                                            <th>изучения</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($users as $user1)
                                            @foreach($user1 as $user)
                                                <tr>
                                                    <td>{{$user->first_name}} {{$user->last_name}}</td>
                                                    @if($user->personalReport->isEmpty())
                                                        <td>Нет отчета</td>
                                                        <td>Нет отчета</td>
                                                        <td>Нет отчета</td>
                                                        <td>Нет отчета</td>
                                                    @else
                                                        @foreach($user->personalReport as $userPersonalReport)
                                                            @foreach($userPersonalReport->user as $userPersonalReportUser)
                                                                @if($user->id == $userPersonalReportUser->id)
                                                                    <td>{{$userPersonalReport->publications}}</td>
                                                                    <td>{{$userPersonalReport->videos}}</td>
                                                                    <td>{{$userPersonalReport->return_visits}}</td>
                                                                    <td>{{$userPersonalReport->bible_studies}}</td>
                                                                @endif
                                                            @endforeach
                                                        @endforeach
                                                    @endif
                                                </tr>
                                            @endforeach
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
    </div>
        <div class="tab-content" id="myPillTabContent">
            <!--            <div class="tab-pane fade active show" id="reportsPIll" role="tabpanel" aria-labelledby="home-icon-pill">
                <div class="card">
                    <div class="card-body">
                        <div class="col-md-12 text-center mb-2">
                            <button class="btn btn-lg btn-outline-primary btn-rounded btn-block" type="button" data-toggle="modal" data-target="#personalReportModal">Новый отчет</button>
                        </div>
                        <div class="col-md-12 text-center mb-2">
                            <button class="btn btn-lg btn-outline-secondary btn-rounded btn-block collapsed" type="button" data-toggle="collapse" href="#collapse-link-collapsed" aria-expanded="false">Мои отчеты</button>
                            <div class="collapse" id="collapse-link-collapsed">
                                <ul class="list-group list-group-flush">
                                    <div class="card-body p-0">
                                        <div class="card-title border-bottom d-flex align-items-center m-0 p-3">
                                        </div>

                                    </div>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

            </div>-->

        </div>
    </div>

@endsection
