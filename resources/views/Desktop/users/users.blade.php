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
                                            <td>
                                                <a class="ul-link-action text-success" href="" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit"><i class="i-Edit"></i></a>
                                                <a class="ul-link-action text-danger mr-1" href="" data-toggle="tooltip" data-placement="top" title="" data-original-title="Want To Delete !!!"><i class="i-Eraser-2"></i></a>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                    <tfoot>
                                    <tr>
                                        <th>Name</th>
                                        <th>Position</th>
                                        <th>Office</th>
                                        <th>Age</th>
                                        <th>Start date</th>
                                        <th>Salary</th>
                                    </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endcan
@endsection
