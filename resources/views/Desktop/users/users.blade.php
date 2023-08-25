@extends('Desktop.layouts.front.app')
@section('title')Stand | @endsection
@section('content')
    <div class="content container-fluid">
        <div class="card">
            <!-- Header -->
            <div class="card-header">
                <div class="row justify-content-between align-items-center flex-grow-1">
                    <div class="col-12 col-md">
                        <div class="d-flex justify-content-between align-items-center">
                            <h5 class="card-header-title">Users</h5>
                        </div>
                    </div>

                    <div class="col-auto">
                        <!-- Filter -->
                        <form>
                            <!-- Search -->
                            <div class="input-group input-group-merge input-group-flush">
                                <div class="input-group-prepend input-group-text">
                                    <i class="bi-search"></i>
                                </div>
                                <input id="datatableWithSearchInput" type="search" class="form-control" placeholder="Search users" aria-label="Search users">
                            </div>
                            <!-- End Search -->
                        </form>
                        <!-- End Filter -->
                    </div>
                </div>
            </div>
            <!-- End Header -->

            <!-- Table -->
            <div class="table-responsive datatable-custom">
                <table class="js-datatable table table-borderless table-thead-bordered table-nowrap table-align-middle card-table"
                       data-hs-datatables-options='{
                   "order": [],
                   "search": "#datatableWithSearchInput",
                   "isResponsive": false,
                   "isShowPaging": false,
                   "pagination": "datatableWithSearchPagination"
                 }'>
                    <thead class="thead-light">
                    <tr>
                        <th>Имя фамилия</th>
                        <th>Роль</th>
                        <th>Номер телефона</th>
                        <th>Группа</th>
                    </tr>
                    </thead>

                    <tbody>
                    @foreach($users as $user)
                        <tr>
                            <td>
                                <a class="d-flex align-items-center" href="{{ route('userCard', $user->id) }}">
                                    <div class="avatar avatar-circle">
                                        <img class="avatar-img" src="{{ asset('front/img/160x160/img1.jpg') }}" alt="Image Description">
                                    </div>
                                    <div class="ms-3">
                                            <span class="d-block h5 text-inherit mb-0"> {{ $user->first_name }} {{ $user->last_name }}
                                                @foreach($user->usersroles as $userRole)
                                                    @if($userRole->role->name === 'Developer')
                                                        <i class="bi-patch-check-fill text-primary" data-toggle="tooltip"
                                                           data-bs-placement="top" title="Top endorsed"></i>
                                                    @else
                                                    @endif
                                                @endforeach
                                            </span>
                                        <span class="d-block fs-5 text-body">{{ $user->email }}</span>
                                    </div>
                                </a>
                            </td>
                            <td>
                                @foreach($user->usersroles as $userRole)
                                    @if($userRole->role->name === 'Developer')
                                        <a class="badge" style="background: #be0101" href="#">Разработчик</a>
                                    @elseif($userRole->role->name === 'Overseer')
                                        <span class="badge bg-secondary">Старейшина</span>
                                    @elseif($userRole->role->name === 'Publisher')
                                        <span class="badge bg-secondary">Возвещатель</span>
                                    @endif
                                @endforeach
                            </td>
                            <td>{{ $user->mobile_phone }}</td>

                            <td>
                                @foreach($user->usersGroups as $userGroup)
                                    {{ $userGroup->group->name }}
                                @endforeach
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <!-- End Table -->

            <!-- Footer -->
            <div class="card-footer">
                <!-- Pagination -->
                <div class="d-flex justify-content-center justify-content-sm-end">
                    <nav id="datatableWithSearchPagination" aria-label="Activity pagination"></nav>
                </div>
                <!-- End Pagination -->
            </div>
            <!-- End Footer -->
        </div>
    </div>
@endsection
