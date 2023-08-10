@extends('layouts.app')
@section('title')Stand | @endsection
@section('content')
    @can('Users-Open congregation users')
        <div class="main-content pt-4">
            <div class="row mb-4">
                <div class="col-md-12 mb-4">
                    <div class="card text-left">
                        <div class="card-body">
                            <h4 class="card-title mb-3">Пользователи</h4>
                            <p></p>
                            <div class="table-responsive">
                                <table class="display table table-striped table-bordered" id="zero_configuration_table" style="width:100%">
                                    <thead>
                                    <tr>
                                        <th>Фамилия Имя</th>
                                        <th>Почта</th>
                                        <th>номер телефона</th>
                                        <th>Роль</th>
                                        <th>Адресс</th>
                                        <th>Группа</th>
                                        @role('Developer')
                                            <th>Login</th>
                                            <th>Последний вход</th>
                                        @endrole
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($users as $user)
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
                                            @role('Developer')
                                            <td>{{ $user->login }}</td>
                                            <td>{{ $user->last_login }}</td>

                                            @endrole

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
    @endcan
@endsection
