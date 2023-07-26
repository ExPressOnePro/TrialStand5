@extends('layouts.app')
@section('title') Meeper | DevTools @endsection
@section('content')

    <div class="main-content pt-4">
        <h1 class="heading text-center font-weight-bold"> Кнопки управления</h1>
        <!-- Информация-->
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-body p-0">
                        <div class="d-flex border-bottom justify-content-between p-3">
                            <div class="flex-grow-1">
                                <span class="text-small text-muted">Количество возвещателей</span>
                                <h5 class="m-0"></h5>
                            </div>
                            <div class="flex-grow-1">
                                <span class="text-small text-muted">Количество групп</span>
                                <h5 class="m-0"></h5>
                            </div>
                            <div class="flex-grow-1">
                                <span class="text-small text-muted">Количество Старейшин</span>
                                <h5 class="m-0"></h5>
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
            <div class="col-lg-4 col-md-4 mb-4">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title">Notification</div>
                        <div class="ul-widget-app__browser-list">
                            <div class="ul-widget-app__browser-list-1 mb-4">
                                <i class="i-Bell1 text-white bg-warning rounded-circle p-2 mr-3"></i>
                                <span class="text-15">Всем роль Publishers</span>
                                <a href="{{route('devRoleUserUpdate')}}">
                                    <button class="btn btn-success">Обновить</button>
                                </a>
                            </div>
                            <div class="ul-widget-app__browser-list-1 mb-4"><i class="i-Internet text-white green-500 rounded-circle p-2 mr-3"></i><span class="text-15">Traffic Overloaded</span><span class="text-mute">4 Hours ago</span></div>
                            <div class="ul-widget-app__browser-list-1 mb-4"><i class="i-Shopping-Cart text-white cyan-500 rounded-circle p-2 mr-3"></i><span class="text-15">New Order Received</span><span class="text-mute">yesterday </span></div>
                            <div class="ul-widget-app__browser-list-1 mb-4"><i class="i-Add-UserStar text-white teal-500 rounded-circle p-2 mr-3"></i><span class="text-15">New User </span><span class="text-mute">2 April </span></div>
                            <div class="ul-widget-app__browser-list-1 mb-4"><i class="i-Bell text-white purple-500 rounded-circle p-2 mr-3"></i><span class="text-15">New Update </span><span class="text-mute">2 April </span></div>
                            <div class="ul-widget-app__browser-list-1 mb-4"><i class="i-Shopping-Cart text-white bg-danger rounded-circle p-2 mr-3"></i><span class="text-15">New Order Received</span><span class="text-mute">yesterday </span></div>
                            <div class="ul-widget-app__browser-list-1 mb-4"><i class="i-Internet text-white green-500 rounded-circle p-2 mr-3"></i><span class="text-15">Traffic Overloaded</span><span class="text-mute">4 Hours ago</span></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

@endsection
