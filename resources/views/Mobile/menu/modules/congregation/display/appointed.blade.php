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
                                    <h5 class="card-header-title"></h5>
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
                                <form action="" method="post">
                                    @csrf
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
                                            <th>Имя пользователя</th>
                                            <th>Ответственность</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($users as $user)
                                            <tr>
                                                <td>{{ $user->first_name }} {{ $user->last_name }}</td>
                                                <td>
                                                    <select class="form-control" name="appointed[{{ $user->id }}]">
                                                        <option value="">- Не выбрано</option>
                                                        <option value="not christened publisher">Некрещенный возвещатель</option>
                                                        <option value="publisher">Возвещатель</option>
                                                        <option value="Ancillary pioneer">Подсобный пионер</option>
                                                        <option value="Regular pioneer">Общий пионер</option>
                                                        <option value="Ministerial servants">Служебный помошник</option>
                                                        <option value="Overseer">Старейшина</option>
                                                    </select>
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                    </div>
                                    <button class="btn btn-outline-success" type="submit">Применить</button>
                                </form>
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
