@extends('Mobile.layouts.front.app')
@section('title') Meeper | Контакты @endsection
@section('content')

    <div class="content container-fluid">
            <!-- Header -->
            <div class="card card-header">
                <div class="row justify-content-between align-items-center flex-grow-1">
                    <div class="col-12">
                        <div class="d-flex justify-content-between align-items-center">
                            <h5 class="card-header-title"></h5>
                        </div>
                    </div>

                    <div class="col">
                        <!-- Filter -->
                        <form>
                            <!-- Search -->
                            <div class="input-group input-group-merge input-group-flush">
                                <div class="input-group-prepend input-group-text">
                                    <i class="bi-search"></i>
                                </div>
                                <input id="datatableWithSearchInput" type="search" class="form-control" placeholder="Поиск" aria-label="Search users">
                            </div>
                            <!-- End Search -->
                        </form>
                        <!-- End Filter -->
                    </div>
                </div>
            </div>
            <!-- End Header -->

            <!-- Table -->
            <div class="card-body table-responsive datatable-custom border rounded-bottom">
                <table class="js-datatable table table-borderless table-thead-bordered table-nowrap table-align-middle card-table"
                       data-hs-datatables-options='{
                   "order": [],
                   "search": "#datatableWithSearchInput",
                   "info": {
                     "totalQty": "#datatableEntriesInfoTotalQty"
                   },
                   "entries": "#datatableEntries",
                   "isResponsive": false,
                   "isShowPaging": false,
                   "pagination": "datatableEntriesPagination"
                 }'>
                    <thead class="thead-light">
                    <tr>
                        <th>Имя фамилия</th>
{{--                        <th>Звонок</th>--}}
                    </tr>
                    </thead>

                    <tbody>
                    @foreach($users as $user)
                        <tr>
                            <td>
                                <div class="row">
                                    <div class="col-9">
                                        <dd>
                                            {{ $user->last_name }} {{ $user->first_name }}
                                            @if (isset($user->info) && $decodedInfo = json_decode($user->info, true))
                                                @if (isset($decodedInfo['mobile_phone']) && !empty($decodedInfo['mobile_phone']))
                                                    <div class="h3"><span class="badge bg-secondary">{{ $decodedInfo['mobile_phone'] }}</span></div>
                                                @endif
                                            @endif
                                        </dd>

                                    </div>
                                    <div class="col-3">
                                        @if (isset($user->info) && $decodedInfo = json_decode($user->info, true))
                                            @if (isset($decodedInfo['mobile_phone']) && !empty($decodedInfo['mobile_phone']))
                                                <button class="btn btn-outline-primary" onclick="callNumber('{{$decodedInfo['mobile_phone']}}')">
                                                    <i class="fa-solid fa-phone"></i>
                                                </button>
                                            @endif
                                        @endif
                                    </div>
                                </div>
{{--                                <div class="card card-body">--}}
{{--                                    <div class="d-flex align-items-md-center">--}}
{{--                                        <div class="flex-grow-1">--}}
{{--                                            <div class="row align-items-md-center">--}}
{{--                                                <div class="col-9 col-md-4 col-lg-3">--}}
{{--                                                    <h4 class="mb-1">--}}
{{--                                                        <a class="text-dark" href="#">{{ $user->last_name }} {{ $user->first_name }}</a>--}}
{{--                                                    </h4>--}}

{{--                                                    @if (isset($user->info) && $decodedInfo = json_decode($user->info, true))--}}
{{--                                                        @if (isset($decodedInfo['mobile_phone']) && !empty($decodedInfo['mobile_phone']))--}}
{{--                                                            <a class="d-flex align-items-center">--}}
{{--                                                                <div class="h1"><span class="badge bg-secondary">{{ $decodedInfo['mobile_phone'] }}</span></div>--}}
{{--                                                            </a>--}}
{{--                                                        @endif--}}
{{--                                                    @endif--}}
{{--                                                </div>--}}
{{--                                                <!-- End Col -->--}}

{{--                                                <!-- End Col -->--}}

{{--                                                <div class="col-3">--}}
{{--                                                    @if (isset($user->info) && $decodedInfo = json_decode($user->info, true))--}}
{{--                                                        @if (isset($decodedInfo['mobile_phone']) && !empty($decodedInfo['mobile_phone']))--}}
{{--                                                            <button class="btn btn-outline-primary" onclick="callNumber('{{$decodedInfo['mobile_phone']}}')">--}}
{{--                                                                <i class="fa-solid fa-phone"></i>--}}
{{--                                                            </button>--}}
{{--                                                        @endif--}}
{{--                                                    @endif--}}
{{--                                                </div>--}}
{{--                                                <!-- End Col -->--}}
{{--                                            </div>--}}
{{--                                            <!-- End Row -->--}}
                                        </div>
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                                <a class="d-flex align-items-center" --}}{{--@role('Developer') href="{{ route('userCard', $user->id) }}" @endrole--}}{{-->--}}
{{--                                            <span class="d-block h5 text-inherit mb-0"> {{ $user->last_name }} {{ $user->first_name }}--}}
{{--                                                @foreach($user->usersroles as $userRole)--}}
{{--                                                    @if($userRole->role->name === 'Developer')--}}
{{--                                                        <i class="bi-patch-check-fill text-primary" data-toggle="tooltip"--}}
{{--                                                           data-bs-placement="top" title="Top endorsed"></i>--}}
{{--                                                    @else--}}
{{--                                                    @endif--}}
{{--                                                @endforeach--}}
{{--                                            </span>--}}
{{--                                    @if (isset($user->info) && $decodedInfo = json_decode($user->info, true))--}}
{{--                                        @if (isset($decodedInfo['mobile_phone']) && !empty($decodedInfo['mobile_phone']))--}}
{{--                                            <a class="d-flex align-items-center">--}}
{{--                                                <div class="h1"><span class="badge bg-secondary">{{ $decodedInfo['mobile_phone'] }}</span></div>--}}
{{--                                            </a>--}}
{{--                                        @endif--}}
{{--                                    @endif--}}
{{--                                </a>--}}
{{--                            </td>--}}
{{--                            <td>--}}
{{--                                @if (isset($user->info) && $decodedInfo = json_decode($user->info, true))--}}
{{--                                    @if (isset($decodedInfo['mobile_phone']) && !empty($decodedInfo['mobile_phone']))--}}
{{--                                        <button class="btn btn-outline-primary" onclick="callNumber('{{$decodedInfo['mobile_phone']}}')">--}}
{{--                                            <i class="fa-solid fa-phone"></i>--}}
{{--                                        </button>--}}
{{--                                    @endif--}}
{{--                                @endif--}}
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
            <div class="row justify-content-center justify-content-sm-between align-items-sm-center">
                <div class="col-sm mb-2 mb-sm-0">
                    <div class="d-flex justify-content-center justify-content-sm-start align-items-center">
                        <span class="me-2">Показать:</span>

                        <!-- Select -->
                        <div class="tom-select-custom">
                            <select id="datatableEntries" class="js-select form-select form-select-borderless w-auto" autocomplete="off"
                                    data-hs-tom-select-options='{
                "searchInDropdown": false,
                "hideSearch": true
              }'>
                                <option value="4">4</option>
                                <option value="6">6</option>
                                <option value="8" selected>8</option>
                                <option value="20">20</option>
                            </select>
                        </div>
                        <!-- End Select -->

                        <span class="text-secondary me-2">из</span>

                        <!-- Pagination Quantity -->
                        <span id="datatableEntriesInfoTotalQty"></span>
                    </div>
                </div>

                <div class="col-sm-auto">
                    <div class="d-flex justify-content-center justify-content-sm-end">
                        <!-- Pagination -->
                        <nav id="datatableEntriesPagination" aria-label="Activity pagination"></nav>
                    </div>
                </div>
            </div>
            <!-- End Pagination -->
        </div>
        <!-- End Footer -->
    </div>

    <script>
        function callNumber(phoneNumber) {
            window.location.href = 'tel:' + phoneNumber;
        }
    </script>

@endsection
