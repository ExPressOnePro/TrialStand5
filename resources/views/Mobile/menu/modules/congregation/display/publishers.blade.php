@extends('Mobile.layouts.front.app')
@section('title') Meeper | Собрание @endsection
@section('content')

    <div class="content container-fluid">
        <div class="page-header">
            <div class="d-flex mb-3">
                <div class="flex-grow-1">
                    <div class="row">
                        <div class="col-lg mb-3 mb-lg-0">
                            <h1 class="page-header-title">{{ $congregation->name }}</h1>
                            <div class="row align-items-center">
                                <div class="col-auto">
                                    <span>Client:</span>
                                    <a href="#"></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            @include('Mobile.menu.modules.congregation.components.navMenu')
        </div>
            <div class="row row-cols-1 row-cols-sm-2 row-cols-lg-3">
                <div class="col mb-3 mb-lg-5">
                    <div class="card">
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
                                            <input id="datatableWithSearchInput1" type="search" class="form-control" placeholder="Search users" aria-label="Search users">
                                        </div>
                                        <!-- End Search -->
                                    </form>
                                    <!-- End Filter -->
                                </div>
                            </div>
                        </div>
                        <!-- Table -->
                        <div class="table-responsive datatable-custom">
                            <table class="js-datatable table table-borderless table-thead-bordered table-nowrap table-align-middle card-table"
                                   data-hs-datatables-options='{
                   "order": [],
                   "search": "#datatableWithSearchInput1",
                   "isResponsive": false,
                   "isShowPaging": true,
                   "pagination": "datatableWithSearchPagination1"
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
                                                <span class="d-block h5 text-inherit mb-0"> {{ $user->first_name }} {{ $user->last_name }}</span>
                                            </a>
                                            {{--    @foreach($user->usersroles as $userRole)--}}
                                            {{--        @if($userRole->role->name === 'Developer')--}}
                                            {{--            <i class="bi-patch-check-fill text-primary" data-toggle="tooltip"--}}
                                            {{--               data-bs-placement="top" title="Top endorsed"></i>--}}
                                            {{--        @else--}}
                                            {{--        @endif--}}
                                            {{--    @endforeach--}}

                                            {{--                                    <span class="d-block fs-5 text-body">{{ $user->email }}</span>--}}

                                        </td>
                                        <td>
                                            @foreach($user->usersroles as $userRole)
                                                @if($userRole->role->name === 'Developer')
                                                    <a class="badge" style="background: #be0101">Разработчик</a>
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

                        <div class="card-footer">
                            <div class="d-flex justify-content-center justify-content-sm-end">
                                <nav id="datatableWithSearchPagination1" aria-label="Activity pagination"></nav>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
@endsection
