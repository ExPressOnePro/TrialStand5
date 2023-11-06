@extends('Mobile.layouts.front.app')
@section('title') Meeper | Activity @endsection
@section('content')

    <div class="content container-fluid">
        <div class="card">
            <!-- Header -->
            <div class="card-header card-header-content-md-between">
                <div class="mb-2 mb-md-0">
                    <form>
                        <!-- Search -->
                        <div class="input-group input-group-merge input-group-flush">
                            <div class="input-group-prepend input-group-text">
                                <i class="bi-search"></i>
                            </div>
                            <input id="datatableSearch" type="search" class="form-control" placeholder="Search users" aria-label="Search users">
                        </div>
                        <!-- End Search -->
                    </form>
                </div>

                <div class="d-grid d-sm-flex justify-content-md-end align-items-sm-center gap-2">
                    <!-- Datatable Info -->
                    <div id="datatableCounterInfo" style="display: none;">
                        <div class="d-flex align-items-center">
                <span class="fs-5 me-3">
                  <span id="datatableCounter">0</span>
                  Selected
                </span>
                            <a class="btn btn-outline-danger btn-sm" href="javascript:;">
                                <i class="bi-trash"></i> Delete
                            </a>
                        </div>
                    </div>
                    <!-- End Datatable Info -->


                </div>
            </div>
            <!-- End Header -->

            <!-- Table -->
            <div class="table-responsive datatable-custom position-relative">
                <table class="js-datatable table table-borderless table-thead-bordered table-nowrap table-align-middle card-table"
                       data-hs-datatables-options='{
                   "order": [],
                   "search": "#datatableWithSearchInput",
                   "entries": "#datatableEntries",
                   "isResponsive": false,
                   "isShowPaging": false,
                   "pagination": "datatableWithSearchPagination"
                 }'>
                    <thead class="thead-light">
                    <tr>
                        {{--                            <th class="table-column-pe-0">--}}
                        {{--                                <div class="form-check">--}}
                        {{--                                    <input class="form-check-input" type="checkbox" value="" id="datatableCheckAll">--}}
                        {{--                                    <label class="form-check-label" for="datatableCheckAll"></label>--}}
                        {{--                                </div>--}}
                        {{--                            </th>--}}
                        <th>Name</th>
                        <th>Activity</th>
                    </tr>
                    </thead>

                    <tbody>
                    @foreach($users as $user)
                        <tr>
                            {{--                            <td class="table-column-pe-0">--}}
                            {{--                                <div class="form-check">--}}
                            {{--                                    <input class="form-check-input" type="checkbox" value="" id="datatableCheckAll1">--}}
                            {{--                                    <label class="form-check-label" for="datatableCheckAll1"></label>--}}
                            {{--                                </div>--}}
                            {{--                            </td>--}}
                            <td class="table-column-ps-0">
                                <a class="d-flex align-items-center" href="{{ route('userCard', $user->id) }}">
                                    <div class="ms-3">
                                        <span class="d-block h5 text-inherit mb-0">{{ $user->last_name }} {{ $user->first_name }}</span>
                                        <span class="d-block h5 text-inherit mb-0">{{ $user->login }}</span>
                                    </div>
                                </a>
                            </td>
                            <td>
                                @php
                                    $userInfo = json_decode($user->info, true);
                                @endphp
                                <span class="d-block h5 text-inherit mb-0">{{ $user->created_at }}</span>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <!-- End Table -->

            <!-- Footer -->
            <div class="card-footer">
                <div class="row justify-content-center justify-content-sm-between align-items-sm-center">
                    <div class="col-sm mb-2 mb-sm-0">
                        <div class="d-flex justify-content-center justify-content-sm-start align-items-center">
                            <span class="me-2">Showing:</span>

                            <!-- Select -->
                            <div class="tom-select-custom">
                                <select id="datatableEntries" class="js-select form-select form-select-borderless w-auto" autocomplete="off" data-hs-tom-select-options='{
                            "searchInDropdown": false,
                            "hideSearch": true
                          }'>
                                    <option value="10">10</option>
                                    <option value="15" selected>15</option>
                                    <option value="20">20</option>
                                    <option value="50">50</option>
                                </select>
                            </div>
                            <!-- End Select -->

                            <span class="text-secondary me-2">of</span>

                            <!-- Pagination Quantity -->
                            <span id="datatableWithPaginationInfoTotalQty"></span>
                        </div>
                    </div>
                    <!-- End Col -->

                    <div class="col-sm-auto">
                        <div class="d-flex justify-content-center justify-content-sm-end">
                            <!-- Pagination -->
                            <nav id="datatablePagination" aria-label="Activity pagination"></nav>
                        </div>
                    </div>
                    <!-- End Col -->
                </div>
                <!-- End Row -->
            </div>
            <!-- End Footer -->
        </div>
    </div>

@endsection
