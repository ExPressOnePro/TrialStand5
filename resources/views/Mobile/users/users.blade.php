@extends('Mobile.layouts.app')
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
                                <table class="table" id="zero_configuration_table">
                                    <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Position</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($users as $user)
                                        <tr>
                                            <td>
                                                <a href="{{ route('userCard', $user->id) }}">
                                                    <div class="ul-widget-app__profile-pic"><h6>{{ $user->first_name }} {{ $user->last_name }}</h6></div>
                                                </a>
                                            </td>
                                            <td>
                                                @foreach($user->usersroles as $userRole)
                                                    @if($userRole->role->name === 'Developer')
                                                        <a class="badge badge-danger" href="#">{{ $userRole->role->name }}</a>
                                                    @else
                                                        <a class="badge badge-light" href="#">{{ $userRole->role->name }}</a>
                                                    @endif
                                                @endforeach
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
    @endcan
@endsection
